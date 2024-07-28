<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\PagamentoRepositoryInterface;
use App\Domain\Repositories\PedidoRepositoryInterface;
use App\Domain\Repositories\StatusPedidoRepository;

class PedidoService
{
    const STATUS_PAGAMENTO = [
        'AGUARDANDO' => 10,
        'APROVADO' => 11,
        'REJEITADO' => 12,
        'CANCELADO' => 13,
        'ERRO' => 14,
    ];

    const STATUS_PEDIDO = [
        'AGUARDANDO' => 1,
        'PRONTO' => 2,
        'EM PREPARACAO' => 3,
        'RECEBIDO' => 4,
        'FINALIZADO' => 5,
        'CANCELADO' => 6
    ];

    protected PedidoRepositoryInterface $pedidoRepository;
    protected PagamentoRepositoryInterface $pagamentoRepository;
    protected StatusPedidoRepository $statusPedidoRepository;
    private MercadoPagoService $mercadoPagoService;

    public function __construct(
        PedidoRepositoryInterface $pedidoRepository,
        PagamentoRepositoryInterface $pagamentoRepository,
        StatusPedidoRepository $statusPedidoRepository,
        MercadoPagoService $mercadoPagoService
    ) {
        $this->pedidoRepository = $pedidoRepository;
        $this->pagamentoRepository = $pagamentoRepository;
        $this->statusPedidoRepository = $statusPedidoRepository;
        $this->mercadoPagoService = $mercadoPagoService;
    }

    public function fakeCheckout(array $data): array
    {
        $pedido = $this->pedidoRepository->create($data);

        $this->statusPedidoRepository->create([
            'PedidoId' => $pedido->id,
            'StatusId' => $this::STATUS_PEDIDO['AGUARDANDO'],
        ]);

        if (!empty($data['pagamentoId'])) {
            $this->pagamentoRepository->create([
                'PedidoId' => $pedido->id,
                'PagamentoId' => $data['pagamentoId'],
                'StatusId' => $this::STATUS_PAGAMENTO['AGUARDANDO'],
            ]);
        }

        $paymentData = $this->mercadoPagoService->createPayment([
            'Produtos' => $data['Produtos']
        ]);

        return [
            'pedido' => $this->pedidoRepository->get($pedido->id),
            'pagamento' => $paymentData
        ];
    }

    public function listarPedidos(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->pedidoRepository->all();
    }

    public function atualizarStatus(array $data, int $id): bool
    {
        return $this->statusPedidoRepository->atualizarStatus($id, $data);
    }
}

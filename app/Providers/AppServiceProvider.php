<?php

namespace App\Providers;

use App\Application\UseCases\ClienteService;
use App\Application\UseCases\PedidoService;
use App\Application\UseCases\ProdutoService;
use App\Domain\Repositories\ClienteRepository;
use App\Domain\Repositories\ClienteRepositoryInterface;
use App\Domain\Repositories\PagamentoRepository;
use App\Domain\Repositories\PagamentoRepositoryInterface;
use App\Domain\Repositories\PedidoRepository;
use App\Domain\Repositories\PedidoRepositoryInterface;
use App\Domain\Repositories\ProdutoRepository;
use App\Domain\Repositories\ProdutoRepositoryInterface;
use App\Domain\Repositories\StatusPedidoRepository;
use App\Domain\Repositories\StatusPedidoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClienteRepositoryInterface::class, ClienteRepository::class);
        $this->app->bind(PedidoRepositoryInterface::class, PedidoRepository::class);
        $this->app->bind(ProdutoRepositoryInterface::class, ProdutoRepository::class);
        $this->app->bind(PagamentoRepositoryInterface::class, PagamentoRepository::class);
        $this->app->bind(StatusPedidoRepositoryInterface::class, StatusPedidoRepository::class);

        $this->app->singleton('ClienteService', function ($app) {
            return $app->make(ClienteService::class);
        });
        $this->app->singleton('PedidoService', function ($app) {
            return $app->make(PedidoService::class);
        });
        $this->app->singleton('ProdutoService', function ($app) {
            return $app->make(ProdutoService::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

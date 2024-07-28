<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Pedido;

class MercadoPagoWebhookController
{
    public function handle(Request $request): \Illuminate\Http\JsonResponse
    {
        Log::info('Webhook recebido', $request->all());

        $topic = $request->input('topic');
        $id = $request->input('id');

        if ($topic === 'payment') {
            Pedido::atualizarStatus($topic, $id);
        }

        return response()->json(['message' => 'Webhook processado com sucesso']);
    }
}

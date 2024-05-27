<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPagamento extends Model
{
    use HasFactory;

    protected $table = 'status_pagamento';

    protected $fillable = ['PedidoId', 'PagamentoId', 'StatusId'];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->DataStatusPagamento = now()->toDateString();
            $model->HoraStatusPagamento = now()->toTimeString();
        });
    }

    public function pedido(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'PedidoId');
    }

    public function pagamento(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pagamento::class, 'PagamentoId');
    }

    public function status(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Status::class, 'StatusId');
    }
}

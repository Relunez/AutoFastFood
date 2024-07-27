<?php

namespace App\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido';

    protected $fillable = ['ClienteId'];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->DataPedido = now()->toDateString();
            $model->HoraPedido = now()->toTimeString();
        });
    }

    public function cliente(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'ClienteId');
    }

    public function statusPagamentos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StatusPagamento::class, 'PedidoId');
    }

    public function pedidoProdutos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PedidoProduto::class, 'PedidoId');
    }

    public function statusPedidos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StatusPedido::class, 'PedidoId');
    }
}

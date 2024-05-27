<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    use HasFactory;

    protected $table = 'pedido_produtos';

    protected $fillable = ['PedidoId', 'ProdutoId', 'ProdutoTipo'];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->DataPedidoProdutos = now()->toDateString();
            $model->HoraPedidoProdutos = now()->toTimeString();
        });
    }

    public function pedido(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'PedidoId');
    }
}

<?php

namespace App\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPedido extends Model
{
    use HasFactory;

    protected $table = 'status_pedido';

    protected $fillable = ['PedidoId', 'StatusId'];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->DataStatus = now()->toDateString();
            $model->HoraStatus = now()->toTimeString();
        });
    }

    public function pedido(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'PedidoId');
    }

    public function status(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Status::class, 'StatusId');
    }
}

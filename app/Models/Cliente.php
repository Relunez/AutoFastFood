<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $fillable = ['CPF', 'Nome', 'Email'];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->DataCliente = now()->toDateString();
            $model->HoraCliente = now()->toTimeString();
        });
    }

    public function pedidos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pedido::class, 'ClienteId');
    }
}

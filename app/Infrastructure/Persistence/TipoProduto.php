<?php

namespace App\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    use HasFactory;

    protected $table = 'tipo_produto';

    protected $fillable = [
        'DescProduto',
    ];

    public function produtos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Produtos::class, 'TipoProdutoId');
    }
}


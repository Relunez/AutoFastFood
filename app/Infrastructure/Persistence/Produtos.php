<?php

namespace App\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = ['Nome', 'Desc', 'Valor', 'TipoProdutoId'];

    protected $with = ['tipoProduto'];

    public function tipoProduto(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TipoProduto::class, 'TipoProdutoId');
    }

    public function pedidoProdutos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PedidoProduto::class, 'ProdutoId');
    }

    public function getDescProdutoAttribute()
    {
        return $this->tipoProduto ? $this->tipoProduto->DescProduto : $this->TipoProdutoId;
    }

    protected $appends = ['DescProduto'];
}

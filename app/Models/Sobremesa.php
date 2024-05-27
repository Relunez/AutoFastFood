<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sobremesa extends Model
{
    use HasFactory;

    protected $table = 'sobremesa';

    protected $fillable = ['NomeSobremesa', 'DescSobremesa', 'ValorSobremesa'];
}

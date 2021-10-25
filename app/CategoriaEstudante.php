<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaEstudante extends Model
{
    protected $table = "categoria_estudantes";

    protected $fillable = [
        'categoria',
        'sigla',
        'estado',
    ];

}
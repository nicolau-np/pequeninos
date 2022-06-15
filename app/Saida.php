<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    protected $table = "saidas";

    protected $fillable = [
        'descricao',
        'data_saida',
        'valor',
        'estado',
    ];
}
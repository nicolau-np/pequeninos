<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $table = "transferencias";

    protected $fillable = [
        'id_estudante',
        'motivo',
        'data_emissao',
        'numero',
        'epoca',
        'ano_lectivo',
        'ano_emissao',
    ];

    public function estudante()
    {
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }
}

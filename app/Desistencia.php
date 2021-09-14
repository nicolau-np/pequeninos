<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desistencia extends Model
{
    protected $table = "desistencias";

    protected $fillable = [
        'id_estudante',
        'motivo',
        'data_saida',
        'ano_lectivo',
    ];

    public function estudante(){
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }
}
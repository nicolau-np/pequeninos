<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaFinal extends Model
{
    protected $table = "nota_finals";

    protected $fillable = [
        'id_estudante',
        'id_disciplina',
        'cap',
        'cpe',
        'cf',
        'data_lancamento',
        'ano_lectivo',
        'estado'
    ];

    public function estudante(){
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }

    public function disciplina(){
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }
}
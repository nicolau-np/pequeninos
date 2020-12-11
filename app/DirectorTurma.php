<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectorTurma extends Model
{
    protected $table = "director_turmas";

    protected $fillable = [
        'id_funcionario',
        'id_turma',
        'ano_lectivo',
    ];

    public function funcionario(){
        return $this->belongsTo(Funcionario::class, 'id_funcionario', 'id');
    }

    public function turma(){
        return $this->belongsTo(Turma::class, 'id_turma', 'id');
    }
}
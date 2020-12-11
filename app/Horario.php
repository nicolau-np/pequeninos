<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = "horarios";

    protected $fillable = [
        'id_funcionario',
        'id_turma',
        'id_disciplina',
        'id_sala',
        'id_hora',
        'semana',
        'estado',
        'ano_lectivo',
    ];

    public function funcionario(){
        return $this->belongsTo(Funcionario::class, 'id_funcionario', 'id');
    }

    public function turma(){
        return $this->belongsTo(Turma::class, 'id_turma', 'id');
    }

    public function sala(){
        return $this->belongsTo(Sala::class, 'id_sala', 'id');
    }
    
    public function hora(){
        return $this->belongsTo(Hora::class, 'id_hora', 'id');
    }

    public function disciplina(){
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    } 

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $table = "turmas";

    protected $fillable = [
        'id_curso',
        'id_classe',
        'id_turno',
        'turma',
    ];
    
    public function curso(){
        return $this->belongsTo(Curso::class, 'id_curso', 'id');
    }
    
    public function classe(){
        return $this->belongsTo(Classe::class, 'id_classe', 'id');
    }
    
    public function turno(){
        return $this->belongsTo(Turno::class, 'id_turno', 'id');
    }

    public function estudante(){
        return $this->hasMany(Estudante::class, 'id_turma', 'id');
    }

    public function historico(){
        return $this->hasMany(HistoricEstudante::class, 'id_turma', 'id');
    }
    
}
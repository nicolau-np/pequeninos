<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = "grades";

    protected $fillable = [
        'id_curso',
        'id_classe',
        'id_disciplina',
        'tipo',
        'nuclear',
        'estado',
    ];

    public function curso(){
        return $this->belongsTo(Curso::class, 'id_curso', 'id');
    }

    public function classe(){
        return $this->belongsTo(Classe::class, 'id_classe', 'id');
    }

    public function disciplina(){
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CadeiraExame extends Model
{
    protected $table = "cadeira_exames";

    protected $fillable = [
        'id_curso',
        'id_classe',
        'id_disciplina',
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
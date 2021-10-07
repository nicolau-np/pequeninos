<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservacaoConjunta extends Model
{
    protected $table = "observacao_conjuntas";

    protected $fillable = [
        'id_curso',
        'id_classe',
        'id_disciplina1',
        'id_disciplina2',
        'estado',
    ];

    public function curso(){
        return $this->belongsTo(Curso::class, 'id_curso', 'id');
    }

    public function classe(){
        return $this->belongsTo(Classe::class, 'id_classe', 'id');
    }

    public function disciplina1(){
        return $this->belongsTo(Disciplina::class, 'id_disciplina1', 'id');
    }

    public function disciplina2(){
        return $this->belongsTo(Disciplina::class, 'id_disciplina2', 'id');
    }

}
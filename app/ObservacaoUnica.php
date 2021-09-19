<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservacaoUnica extends Model
{
    protected $table = "observacao_unicas";

    protected $fillable = [
        'id_curso',
        'id_classe',
        'id_disciplina',
        'quantidade_negativas',
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

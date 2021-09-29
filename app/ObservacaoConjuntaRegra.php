<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservacaoConjuntaRegra extends Model
{
    protected $table = "observacao_conjunta_regras";

    protected $fillable = [
        'id_observacao_conjunta',
        'id_disciplina',
        'estado',
    ];

    public function observacao_conjunta(){
        return $this->belongsTo(ObservacaoConjunta::class, 'id_observacao_conjunta', 'id');
    }

    public function disciplina(){
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }
}
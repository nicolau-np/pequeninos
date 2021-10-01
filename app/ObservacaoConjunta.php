<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservacaoConjunta extends Model
{
    protected $table = "observacao_conjuntas";

    protected $fillable = [
        'id_curso',
        'id_classe',
        'estado',
    ];

    public function curso(){
        return $this->belongsTo(Curso::class, 'id_curso', 'id');
    }

    public function classe(){
        return $this->belongsTo(Classe::class, 'id_classe', 'id');
    }

    public function observacao_conjunta_regra(){
        return $this->hasMany(ObservacaoConjuntaRegra::class, 'id_observacao_conjunta', 'id');
    }
}

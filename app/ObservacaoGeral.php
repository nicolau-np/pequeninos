<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservacaoGeral extends Model
{
    protected $table = "observacao_gerals";

    protected $fillable = [
        'id_curso',
        'id_classe',
        'designacao',
        'quantidade_negativas',
        'estado',
    ];

    public function curso(){
        return $this->belongsTo(Curso::class, 'id_curso', 'id');
    }

    public function classe(){
        return $this->belongsTo(Classe::class, 'id_classe', 'id');
    }
}
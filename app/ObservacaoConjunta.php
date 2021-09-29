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

    }

    public function classe(){

    }

    public function observacao_conjunta(){
        
    }
}
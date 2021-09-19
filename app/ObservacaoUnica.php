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
}
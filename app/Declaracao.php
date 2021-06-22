<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Declaracao extends Model
{
    protected $table = "declaracaos";

    protected $fillable = [
        'id_estudante',
        'tipo',
        'ano_lectivo',
        'data_emissao',
    ];

    public function estudante(){
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }
}
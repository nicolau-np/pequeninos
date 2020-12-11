<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = "avaliacaos";

    protected $fillable = [
        'id_estudante',
        'id_disciplina',
        'epoca',
        'valo1',
        'data1',
        'valo2',
        'data2',
        'valo3',
        'data3',
        'ano_lectivo'
    ];

    public function estudante(){
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }
    
    public function disciplina(){
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }

    
}
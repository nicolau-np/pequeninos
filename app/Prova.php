<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prova extends Model
{
    protected $table = "provas";

    protected $fillable = [
        'id_estudante',
        'id_disciplina',
        'epoca',
        'valor1', 
        'data1',
        'valor2', 
        'data2',
        'ano_lectivo'
    ];

    
    public function estudante(){
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }
    
    public function disciplina(){
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }
}
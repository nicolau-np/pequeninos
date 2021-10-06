<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EjaNotaFinal extends Model
{
    protected $table = "eja_nota_finals";

    protected $fillable = [
        'id_estudante',
        'id_disciplina',
        'media',
        'nf',
        'rec',
        'estado',
        'ano_lectivo',
    ];

    public function estudante(){
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }

    public function disciplina(){
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }
}

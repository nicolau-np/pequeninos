<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaTrimestral extends Model
{
    protected $table = "nota_trimestrals";

    protected $fillable = [
        'id_estudante',
        'id_disciplina',
        'epoca',
        'mac',
        'cpp',
        'ct',
        'data_lancamento',
        'ano_lectivo',
        'estado'
    ];

    public function estudante(){
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }

    public function disciplina(){
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }
}
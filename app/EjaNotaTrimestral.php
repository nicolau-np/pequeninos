<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EjaNotaTrimestral extends Model
{
    protected $table = "eja_nota_trimestrals";

    protected $fillable = [
        'id_estudante',
        'id_disciplina',
        //nota trimestarl
        'mes1',
        'mes2',
        'mes3',

        'prova',
        'subtotal',
        'tcp',
        'autoav',
        'media_trimestre',

        'epoca',
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
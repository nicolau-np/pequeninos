<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EjaNotaMensal extends Model
{
    protected $table = "eja_nota_mensals";

    protected $fillable = [
        'id_estudante',
        'id_disciplina',
        //primeiro semana
        'tpc1',
        'oc1',
        'pg1',
        'pa1',
        'tp1',
        //segundo semana
        'tpc2',
        'oc2',
        'pg2',
        'pa2',
        'tp2',
        //terceiro semana
        'tpc3',
        'oc3',
        'pg3',
        'pa3',
        'tp3',
        //quarta semana
        'tpc4',
        'oc4',
        'pg4',
        'pa4',
        'tp4',
        //media mes
        'tpc_media',
        'oc_media',
        'pg_media',
        'pa_media',
        'tp_media',

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

    public static function calc_medias_mensais($somas){
        $media = $somas/4;
        return $media;
    }


}

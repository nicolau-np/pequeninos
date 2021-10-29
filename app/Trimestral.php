<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trimestral extends Model
{
    protected $table = "trimestrals";

    protected $fillable = [
        'id_estudante',
        'id_disciplina',
        'epoca',
        'av1',
        'av1_data',
        'av2',
        'av2_data',
        'av3',
        'av3_data',
        'mac',
        'npp',
        'npp_data',
        'pt',
        'pt_data',
        'mt',
        'estado',
        'ano_lectivo',
    ];

    public function estudante()
    {
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }
 
    public static function mac($soma_avaliacoes, $quant_avaliacoes){
        $mac = ($soma_avaliacoes)/$quant_avaliacoes;

        return $mac;
    }

    public static function mt($somas, $quant_notas){
        $mt = $somas/$quant_notas;

        return $mt;
    }

    public static function getNotasEstudantes($data2, $ano_lectivo, $epoca)
    {
        $data = [
            'ano_lectivo' => $ano_lectivo,
            'epoca' => $epoca
        ];
        return Trimestral::whereHas('estudante', function ($query) use ($data2) {
            $query->where('id_turma', $data2['id_turma']);
            $query->where('id_disciplina', $data2['id_disciplina']);
        })->where($data)->get();
    }

}
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

    public function estudante()
    {
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }

    public static function mac($soma_avaliacao, $quant_avaliacao)
    {
        $mac = ($soma_avaliacao / $quant_avaliacao);
        return $mac;
    }

    public static function cpp($soma_prova, $quant_prova)
    {
        $cpp = ($soma_prova / $quant_prova);
        return $cpp;
    }

    public static function ct($mac, $cpp)
    {
        $ct = ($mac + $cpp) / 2;
        return $ct;
    }

    public static function soma_ct($id_estudante, $id_disciplina, $ano_lectivo)
    {
        $soma = 0;
        $trimestral = NotaTrimestral::where([
            'id_estudante' => $id_estudante,
            'id_disciplina' => $id_disciplina,
            'ano_lectivo' => $ano_lectivo
        ])->get();

        foreach($trimestral as $trimestre){
            if($trimestre->ct!=null){
                $soma = $soma + $trimestre->ct;
            }
        }

        return $soma;
    }
}
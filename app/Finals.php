<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finals extends Model 
{
    protected $table = "finals";

    protected $fillable = [
        'id_estudante',
        'id_disciplina',
        'mfd',
        'npe',
        'npe_data',
        'mf',
        'rec_data',
        'rec',
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

    public static function mfd($soma_mts)
    {
        $mfd = ($soma_mts) / 3;

        return $mfd;
    }
    public static function mf($soma_mts)
    {
        $mf = ($soma_mts) / 3;

        return $mf;
    }

    public static function mf_exame($mfd, $npe)
    {
        $mf = (($mfd * 0.4) + ($npe * 0.6));

        return $mf;
    }

    public static function getNotasEstudantes($data2, $ano_lectivo)
    {
        $data = [
            'ano_lectivo' => $ano_lectivo
        ];
        return Finals::whereHas('estudante', function ($query) use ($data2) {
            $query->where('id_turma', $data2['id_turma']);
            $query->where('id_disciplina', $data2['id_disciplina']);
        })->where($data)->get();
    }
}
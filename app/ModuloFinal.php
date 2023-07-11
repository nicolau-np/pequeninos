<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuloFinal extends Model
{
    protected $fillable = [
        'id_estudante',
        'id_disciplina',
        'id_turma',
        'ms1',
        'ms2',
        'mfd',
        'exame',
        'mf',
        'ano_lectivo',
        'obs',
    ];

    public function estudante()
    {
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'id_disciplina', 'id');
    }

    public static function mfd($ms1, $ms2)
    {
        $mfd = ($ms1 + $ms2) / 2;
        return $mfd;
    }

    public static function mf($mfd, $exame)
    {
        $mf = ($mfd * 0.4) + ($exame * 0.6);
        return $mf;
    }
}
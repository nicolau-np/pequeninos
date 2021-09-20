<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finals extends Model
{
    protected $table = "finals";

    protected $fillable = [
        'id_estudante',
        'id_disciplina',
        'cap',
        'mfd',
        'mfd_data',
        'mf',
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

    public static function cap(){

    }
    public static function mfd(){

    }
}
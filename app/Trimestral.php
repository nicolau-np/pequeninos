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
}
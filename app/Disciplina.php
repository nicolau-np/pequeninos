<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = "disciplinas";

    protected $fillable = [
        'id_componente',
        'disciplina',
        'sigla',
    ];

    public function componente(){
        return $this->belongsTo(CompoDisciplina::class, 'id_componente', 'id');
    }

    public function grade(){
        return $this->hasMany(Grade::class, 'id_disciplina', 'id');
    }

    public function horario(){
        return $this->hasMany(Horario::class, 'id_disciplina', 'id');
    }
}
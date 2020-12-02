<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompoDisciplina extends Model
{
    protected $table = "compo_disciplinas";

    protected $fillable = [
        'componente'
    ];

    public function disciplina(){
        return $this->hasMany(Disciplina::class, 'id_componente', 'id');
    }
}
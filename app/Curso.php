<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = "cursos";

    protected $fillable = [
        'id_ensino',
        'curso',
    ];

    public function ensino(){
        return $this->belongsTo(Ensino::class, 'id_ensino', 'id');
    }

    public function tabela_preco(){
        return $this->hasMany(TabelaPreco::class, 'id_curso', 'id');
    }

    public function grade(){
        return $this->hasMany(Grade::class, 'id_curso', 'id');
    }

    public function observacao_geral(){
        return $this->hasMany(ObservacaoGeral::class, 'id_curso', 'id');
    }

    public function observacao_unica(){
        return $this->hasMany(ObservacaoUnica::class, 'id_curso', 'id');
    }

    public function observacao_conjunta(){
        return $this->hasMany(ObservacaoConjunta::class, 'id_curso', 'id');
    }
}
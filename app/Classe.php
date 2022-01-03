<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = "classes";

    protected $fillable = [
        'id_ensino',
        'classe',
    ];

    public function ensino(){
        return $this->belongsTo(Ensino::class, 'id_ensino', 'id');
    }

    public function turma(){
        return $this->hasMany(Turma::class, 'id_classe', 'id');
    }

    public function tabela_preco(){
        return $this->hasMany(TabelaPreco::class, 'id_classe', 'id');
    }

    public function grade(){
        return $this->hasMany(Grade::class, 'id_classe', 'id');
    }

    public function observacao_geral(){
        return $this->hasMany(ObservacaoGeral::class, 'id_classe', 'id');
    }


    public function observacao_conjunta(){
        return $this->hasMany(ObservacaoConjunta::class, 'id_classe', 'id');
    }

    public function cadeira_recurso(){
        return $this->hasMany(CadeiraRecurso::class, 'id_classe', 'id');
    }

    public function cadeira_exame(){
        return $this->hasMany(CadeiraExame::class, 'id_classe', 'id');
    }

    public function ordena_disciplina(){
        return $this->hasMany(OrdenaDisciplina::class, 'id_classe', 'id');
    }
}
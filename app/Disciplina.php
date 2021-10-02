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

    public function avaliacao(){
        return $this->hasMany(Avaliacao::class, 'id_disciplina', 'id');
    }

    public function prova(){
        return $this->hasMany(Prova::class, 'id_disciplina', 'id');
    }

    public function notas_trimestrais(){
        return $this->hasMany(NotaTrimestral::class, 'id_disciplina', 'id');
    }

    public function nota_final(){
        return $this->hasMany(NotaFinal::class, 'id_disciplina', 'id');
    }

    public function observacao_unica(){
        return $this->hasMany(ObservacaoUnica::class, 'id_disciplina', 'id');
    }

    public function observacao_conjunta_regra(){
        return $this->hasMany(ObservacaoConjuntaRegra::class, 'id_disciplina', 'id');
    }

    public function cadeira_recurso(){
        return $this->hasMany(CadeiraRecurso::class, 'id_disciplina', 'id');
    }

    public function cadeira_exame(){
        return $this->hasMany(CadeiraExame::class, 'id_disciplina', 'id');
    }

}
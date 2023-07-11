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

    public function componente()
    {
        return $this->belongsTo(CompoDisciplina::class, 'id_componente', 'id');
    }

    public function grade()
    {
        return $this->hasMany(Grade::class, 'id_disciplina', 'id');
    }

    public function horario()
    {
        return $this->hasMany(Horario::class, 'id_disciplina', 'id');
    }

    public function avaliacao()
    {
        return $this->hasMany(Avaliacao::class, 'id_disciplina', 'id');
    }

    public function prova()
    {
        return $this->hasMany(Prova::class, 'id_disciplina', 'id');
    }

    public function notas_trimestrais()
    {
        return $this->hasMany(NotaTrimestral::class, 'id_disciplina', 'id');
    }

    public function nota_final()
    {
        return $this->hasMany(NotaFinal::class, 'id_disciplina', 'id');
    }

    public function modulo_final()
    {
        return $this->hasMany(ModuloFinal::class, 'id_disciplina', 'id');
    }

    public function cadeira_recurso()
    {
        return $this->hasMany(CadeiraRecurso::class, 'id_disciplina', 'id');
    }

    public function cadeira_exame()
    {
        return $this->hasMany(CadeiraExame::class, 'id_disciplina', 'id');
    }

    public function eja_nota_mensal()
    {
        return $this->hasMany(EjaNotaMensal::class, 'id_disciplina', 'id');
    }

    public function eja_nota_trimestral()
    {
        return $this->hasMany(EjaNotaTrimestral::class, 'id_disciplina', 'id');
    }

    public function eja_nota_final()
    {
        return $this->hasMany(EjaNotaFinal::class, 'id_disciplina', 'id');
    }

    public function obs_conjunta1()
    {
        return $this->hasMany(ObservacaoConjunta::class, 'id_disciplina1', 'id');
    }

    public function obs_conjunta2()
    {
        return $this->hasMany(ObservacaoConjunta::class, 'id_disciplina2', 'id');
    }

    public function ordena_disciplina()
    {
        return $this->hasMany(OrdenaDisciplina::class, 'id_disciplina', 'id');
    }
}
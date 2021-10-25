<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricEstudante extends Model
{
    protected $table = "historic_estudantes";

    protected $fillable = [
        'id_estudante',
        'id_turma',
        'numero',
        'numero_acesso',
        'estado',
        'observacao_final',
        'obs_pauta',
        'ano_lectivo',
    ];

    public function estudante(){
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }

    public function turma(){
        return $this->belongsTo(Turma::class, 'id_turma', 'id');
    }

    public function documento_entregues(){
        return $this->hasMany(DocumentoEntregue::class, 'id_historico', 'id');
    }
}
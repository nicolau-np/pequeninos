<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    protected $table = "estudantes";

    protected $fillable = [
        'id_turma',
        'id_pessoa',
        'estado',
        'ano_lectivo',
    ];

    public function turma(){
        return $this->belongsTo(Turma::class, 'id_turma', 'id');
    }
    
    public function pessoa(){
        return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id');
    }

    public function pagamento(){
        return $this->hasMany(Pagamento::class, 'id_estudante', 'id');
    }

    public function historico(){
        return $this->hasMany(HistoricEstudante::class, 'id_estudante', 'id');
    }

}
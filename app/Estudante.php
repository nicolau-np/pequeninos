<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    protected $table = "estudantes";

    protected $fillable = [
        'id_turma',
        'id_pessoa',
        'id_encarregado',
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

    public function encarregado(){
        return $this->belongsTo(Encarregado::class, 'id_encarregado', 'id');
    }

    public function avaliacao()
    {
        return $this->hasMany(Avaliacao::class, 'id_estudante', 'id');
    }

    public function prova()
    {
        return $this->hasMany(Prova::class, 'id_estudante', 'id');
    }

    public function notas_trimestrais()
    {
        return $this->hasMany(NotaTrimestral::class, 'id_estudante', 'id');
    }

    public function nota_final()
    {
        return $this->hasMany(NotaFinal::class, 'id_estudante', 'id');
    }

}
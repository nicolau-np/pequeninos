<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = "pessoas";

    protected $fillable = [
        'id_municipio',
        'nome',
        'data_nascimento',
        'genero',
        'email',
        'estado_civil',
        'naturalidade',
        'telefone',
        'bilhete',
        'data_emissao',
        'local_emissao',
        'pai',
        'mae',
        'comuna',
        'residencia',
        'rua',
        'bairro',
        'foto',
    ];

    public function municipio(){
        return $this->belongsTo(Municipio::class, 'id_municipio', 'id');
    }

    public function usuario(){
        return $this->hasMany(User::class, 'id_pessoa', 'id');
    }

    public function estudante(){
        return $this->hasMany(Estudante::class, 'id_pessoa', 'id');
    }

    public function funcionario(){
        return $this->hasMany(Funcionario::class, 'id_pessoa', 'id');
    }
}
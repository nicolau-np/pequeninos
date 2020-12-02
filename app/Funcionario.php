<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = "funcionarios";

    protected $fillable = [
        'id_cargo',
        'id_escalao',
        'id_pessoa',
        'estado',
    ];

    public function escalao(){
        return $this->belongsTo(Escalao::class, 'id_escalao', 'id');
    }

    public function cargo(){
        return $this->belongsTo(Cargo::class, 'id_cargo', 'id');
    }
}
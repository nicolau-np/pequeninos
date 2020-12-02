<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escalao extends Model
{
    protected $table = "escalaos";

    protected $fillable = [
        'escalao',
    ];

    public function funcionario(){
        return $this->hasMany(Funcionario::class, 'id_escalao', 'id');
    }
}
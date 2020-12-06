<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $table = "turnos";

    protected $fillable = [
        'turno',
    ];

    public function turma(){
        return $this->hasMany(Turma::class, 'id_turno', 'id');
    }

    public function hora(){
        return $this->hasMany(Hora::class, 'id_turno', 'id');
    }
}
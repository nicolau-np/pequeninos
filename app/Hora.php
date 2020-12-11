<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{
    protected $table = "horas";

    protected $fillable = [
        'id_turno',
        'hora_entrada',
        'hora_saida',
    ];

    public function turno(){
        return $this->belongsTo(Turno::class, 'id_turno', 'id');
    }

    public function horario(){
        return $this->hasMany(Horario::class, 'id_hora', 'id');
    }
}
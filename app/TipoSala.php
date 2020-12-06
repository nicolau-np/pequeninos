<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSala extends Model
{
    protected $table = "tipo_salas";

    protected $fillable = [
        'tipo',
    ];

    public function sala(){
        return $this->hasMany(Sala::class, 'id_tipo_sala', 'id');
    }
}
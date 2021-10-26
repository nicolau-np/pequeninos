<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloqueioEpoca extends Model
{
    protected $table = "bloqueio_epocas";

    protected $fillable = [
        'epoca',
        'estado',
    ];

    public function config_bloqueio(){
        return $this->hasMany(ConfigBloqueio::class, 'id_bloqueio', 'id');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigBloqueio extends Model
{
    protected $table = "config_bloqueios";

    protected $fillable = [
        'id_bloqueio',
        'tipo',
        'estado',
    ];

    public function bloqueio_epoca(){
        return $this->belongsTo(BloqueioEpoca::class, 'id_bloqueio', 'id');
    }
}

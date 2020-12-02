<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = "provincias";

    protected $fillable = [
        'id_pais',
        'provincia',
        'cidade_cede',
    ];

    public function pais(){
        return $this->belongsTo(Pais::class, 'id_pais', 'id');
    }

    public function municipio(){
        return $this->hasMany(Municipio::class, 'id_provincia', 'id');
    }
}
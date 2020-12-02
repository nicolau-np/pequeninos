<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = "pais";

    protected $fillable = [
        'pais',
        'capital',
        'indicativo',
        'img_bandeira',
    ];

    public function provincia(){
        return $this->hasMany(Provincia::class, 'id_pais', 'id');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ensino extends Model
{
    protected $table ="ensinos";

    protected $fillable = [
        'ensino',
    ];

    public function curso(){
        return $this->hasMany(Curso::class, 'id_ensino', 'id');
    }

    public function classe(){
        return $this->hasMany(Classe::class, 'id_ensino', 'id');
    }
}
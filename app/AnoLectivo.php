<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnoLectivo extends Model
{
    protected $table = "ano_lectivos";

    protected $fillable = [
        'ano_lectivo',
    ];

}
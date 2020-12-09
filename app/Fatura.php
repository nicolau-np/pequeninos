<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    protected $table = "faturas";

    protected $fillable = [
        'data_fatura',
        'ano',
    ];
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encarregado extends Model
{
    protected $table = "encarregados";

    protected $fillable = [
        'id_pessoa',
        'estado',
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id');
    }
}
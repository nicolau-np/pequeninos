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

    public function estudante(){
        return $this->hasMany(Estudante::class, 'id_encarregado', 'id');
    }

    public function pagamento_pai(){
        return $this->hasMany(PagamentoPai::class, 'id_encarregado', 'id');
    }
}
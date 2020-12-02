<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = "classes";

    protected $fillable = [
        'id_ensino',
        'classe',
    ];

    public function ensino(){
        return $this->belongsTo(Ensino::class, 'id_ensino', 'id');
    }

    public function turma(){
        return $this->hasMany(Turma::class, 'id_classe', 'id');
    }

    public function tabela_preco(){
        return $this->hasMany(TabelaPreco::class, 'id_classe', 'id');
    }

    public function grade(){
        return $this->hasMany(Grade::class, 'id_classe', 'id');
    }
}
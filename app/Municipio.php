<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = "municipios";

    protected $fillable = [
        'id_pais',
        'provincia',
        'cidade_cede',
    ];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'id_provincia', 'id');
    }

    public function pessoa()
    {
        return $this->hasMany(Pessoa::class, 'id_municipio', 'id');
    }
}
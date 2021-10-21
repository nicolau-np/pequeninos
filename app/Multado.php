<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multado extends Model
{
    protected $table = "multados";

    protected $fillable = [
        'id_estudante',
        'id_tipo_pagamento',
        'mes_multa',
        'mes',
        'percentagem',
        'dia_multado',
        'estado',
        'ano_lectivo',
    ];

    public function estudante()
    {
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }

    public function tipo_pagamento()
    {
        return $this->belongsTo(TipoPagamento::class, 'id_tipo_pagamento', 'id');
    }
}
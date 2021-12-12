<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestricaoNota extends Model
{
    protected $table = "restricao_notas";

    protected $fillable = [
        'id_tipo_pagamento',
        'id_estudante',
        'epoca',
        'mes',
        'mes_numero',
        'ano_lectivo',
        'estado',
    ];

    public function tipo_pagamento()
    {
        return $this->belongsTo(TipoPagamento::class, 'id_tipo_pagamento', 'id');
    }

    public function estudante()
    {
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }
}
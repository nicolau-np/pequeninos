<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TabelaPreco extends Model
{
    protected $table = "tabela_precos";
    
    protected $fillable = [
        'id_tipo_pagamento',
        'id_curso',
        'id_classe',
        'preco', 
    ];

    public function tipo_pagamento(){
        return $this->belongsTo(TipoPagamento::class, 'id_tipo_pagamento', 'id');
    }

    public function curso(){
        return $this->belongsTo(Curso::class, 'id_curso', 'id');
    }

    public function classe(){
        return $this->belongsTo(Classe::class, 'id_classe', 'id');
    }
}
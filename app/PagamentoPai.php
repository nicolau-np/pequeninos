<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagamentoPai extends Model
{
    protected $table = "pagamento_pais";

    protected $fillable = [
        'id_tipo_pagamento',
        'id_usuario',
        'id_encarregado',
        'epoca',
        'preco',
        'data_pagamento',
        'fatura',
        'mes_pagamento',
        'ano_lectivo',
    ];

    public function tipo_pagamento(){
        return $this->belongsTo(TipoPagamento::class, 'id_tipo_pagamento', 'id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function encarregado(){
        return $this->belongsTo(Encarregado::class, 'id_estudante', 'id');
    }
}
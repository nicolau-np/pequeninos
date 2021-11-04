<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Pagamento extends Model
{
    protected $table = "pagamentos";

    protected $fillable = [
        'id_tipo_pagamento',
        'id_usuario',
        'id_estudante',
        'epoca',
        'preco',
        'data_pagamento',
        'fatura',
        'mes_pagamento',
        'descricao',
        'ano_lectivo',
    ];

    public function tipo_pagamento(){
        return $this->belongsTo(TipoPagamento::class, 'id_tipo_pagamento', 'id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function estudante(){
        return $this->belongsTo(Estudante::class, 'id_estudante', 'id');
    }
}
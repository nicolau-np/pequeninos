<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPagamento extends Model
{
    protected $table = "tipo_pagamentos";

    protected $fillable = [
        'tipo',
        'multa',
        'dia_cobranca_multa'
    ];

    public function tabela_pagamento()
    {
        return $this->hasMany(TabelaPreco::class, 'id_tipo_pagamento', 'id');
    }

    public function pagamento()
    {
        return $this->hasMany(Pagamento::class, 'id_tipo_pagamento', 'id');
    }

    public function pagamento_pai()
    {
        return $this->hasMany(PagamentoPai::class, 'id_tipo_pagamento', 'id');
    }

    public function multado(){
        return $this->hasMany(Multado::class, 'id_tipo_pagamento', 'id');
    }

    public function restricao_nota(){
        return $this->hasMany(RestricaoNota::class, 'id_tipo_pagamento', 'id');
    }
}

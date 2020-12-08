<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EpocaPagamento extends Model
{
    protected $table = "epoca_pagamentos";

    protected $fillable = [
        'id_forma_pagamento',
        'epoca',
    ];

    public function forma_pagamento(){
        return $this->belongsTo(FormaPagamento::class, 'id_forma_pagamento', 'id');
    }
}
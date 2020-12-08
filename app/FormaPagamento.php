<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    protected $table = "forma_pagamentos";

    protected $fillable = [
        'forma_pagamento',
    ];

    public function epoca_pagamento(){
        return $this->hasMany(EpocaPagamento::class, 'id_forma_pagamento', 'id');
    }
}
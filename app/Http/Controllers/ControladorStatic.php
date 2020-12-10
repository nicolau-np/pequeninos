<?php

namespace App\Http\Controllers;

use App\PagamentoPai;
use App\TipoPagamento;
use Illuminate\Http\Request;

class ControladorStatic extends Controller
{
    public static function getPagamentosComparticipacao($id_encarregado, $epoca, $ano_lectivo){
        $data = [
            'id_encarregado'=>$id_encarregado,
            'epoca'=>$epoca,
            'ano_lectivo'=>$ano_lectivo
        ];
        $comparticipacao = PagamentoPai::where($data)->first();
        return $comparticipacao;
    }

    public static function getValoresBalanco($epoca, $id_tipo_pagamento, $ano_lectivo){
        
        $data = [
            'epoca'=>$epoca,
            'id_tipo_pagamento'=>$id_tipo_pagamento,
            'ano_lectivo'=>$ano_lectivo,
        ];

        
        return 233;
    }
}
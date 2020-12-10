<?php

namespace App\Http\Controllers;

use App\Pagamento;
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
        $retorno = 0;
        $data = [
            'epoca'=>$epoca,
            'id_tipo_pagamento'=>$id_tipo_pagamento,
            'ano_lectivo'=>$ano_lectivo,
        ];

        if($id_tipo_pagamento == 3){
            $pagamentos = PagamentoPai::where('id_tipo_pagamento', $id_tipo_pagamento)->get();
            foreach($pagamentos as $pagamento){
                $retorno = $retorno + $pagamento->preco;
            }
            
        }else{
            $pagamentos = Pagamento::where('id_tipo_pagamento', $id_tipo_pagamento)->get();
            foreach($pagamentos as $pagamento){
                $retorno = $retorno + $pagamento->preco;
            }
        }
        
        return $retorno;
    }
}
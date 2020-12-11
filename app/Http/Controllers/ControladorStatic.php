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

    public static function converterMes($mes){
        $mes_extenso = null;
       if($mes == 1){
          $mes_extenso = "Jan";
       }elseif($mes == 2){
        $mes_extenso = "Fev";
       }elseif($mes == 3){
        $mes_extenso = "Mar";
       }elseif($mes == 4){
        $mes_extenso = "Abr";
       }elseif($mes == 5){
        $mes_extenso = "Mai";
       }elseif($mes == 6){
        $mes_extenso = "Jun";
       }elseif($mes == 7){
        $mes_extenso = "Jul";
       }elseif($mes == 8){
        $mes_extenso = "Ago";
       }elseif($mes == 9){
        $mes_extenso = "Set";
       }elseif($mes == 10){
        $mes_extenso = "Out";
       }elseif($mes == 11){
        $mes_extenso = "Nov";
       }elseif($mes == 12){
        $mes_extenso = "Dez";
       }
       
       return $mes_extenso;
    }

    public static function getValoresBalancoTrimestral($epoca, $id_tipo_pagamento, $ano_lectivo){
        $retorno = 0;
        $data = [
            'epoca'=>$epoca,
            'id_tipo_pagamento'=>$id_tipo_pagamento,
            'ano_lectivo'=>$ano_lectivo,
        ];

        if($id_tipo_pagamento == 3){
            $pagamentos = PagamentoPai::where($data)->get();
            foreach($pagamentos as $pagamento){
                $retorno = $retorno + $pagamento->preco;
            }
            
        }else{
            $pagamentos = Pagamento::where($data)->get();
            foreach($pagamentos as $pagamento){
                $retorno = $retorno + $pagamento->preco;
            }
        }
        
        return $retorno;
    }

    public static function getValoresBalancoMensal($mes, $id_tipo_pagamento, $ano_lectivo){
        $retorno = 0;
        $data = [
            'mes_pagamento'=>$mes,
            'id_tipo_pagamento'=>$id_tipo_pagamento,
            'ano_lectivo'=>$ano_lectivo,
        ];

        if($id_tipo_pagamento == 3){
            $pagamentos = PagamentoPai::where($data)->get();
            foreach($pagamentos as $pagamento){
                $retorno = $retorno + $pagamento->preco;
            }
            
        }else{
            $pagamentos = Pagamento::where($data)->get();
            foreach($pagamentos as $pagamento){
                $retorno = $retorno + $pagamento->preco;
            }
        }
        
        return $retorno;
    }

    public static function getValoresBalancoAnual($id_tipo_pagamento, $ano_lectivo){
        $retorno = 0;
        $data = [
            'id_tipo_pagamento'=>$id_tipo_pagamento,
            'ano_lectivo'=>$ano_lectivo,
        ];

        if($id_tipo_pagamento == 3){
            $pagamentos = PagamentoPai::where($data)->get();
            foreach($pagamentos as $pagamento){
                $retorno = $retorno + $pagamento->preco;
            }
            
        }else{
            $pagamentos = Pagamento::where($data)->get();
            foreach($pagamentos as $pagamento){
                $retorno = $retorno + $pagamento->preco;
            }
        }
        
        return $retorno;
    }
}
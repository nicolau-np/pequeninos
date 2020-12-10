<?php

namespace App\Http\Controllers;

use App\PagamentoPai;
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
}
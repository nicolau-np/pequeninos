<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Curso;
use App\EpocaPagamento;
use App\FormaPagamento;
use App\TipoPagamento;
use Illuminate\Http\Request;

class EstatisticaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function lista_pagamento(){
        $tipo_pagamentos = TipoPagamento::pluck('tipo', 'id');
        $cursos = Curso::pluck('curso', 'id');
        $data = [
            'title' => "Lista de Pagamentos",
            'type' => "estatisticas",
            'menu' => "Listas de Pagamentos",
            'submenu' => "Listar",
            'getTipoPagamentos'=>$tipo_pagamentos,
            'getCursos'=>$cursos,
        ];
        return view('estatistica.pagamento.list', $data);
    }

    public function balanco(){
        $data = [
            'title' => "Balanços",
            'type' => "estatisticas",
            'menu' => "Balanços",
            'submenu' => "Listar",
        ];
        return view('estatistica.balanco.list', $data);
    }

    public function grafico(Request $request){
        $request->validate([
            'ano_lectivo'=>['required', 'Integer'],
            'forma_pagamento'=>['required', 'string'],
        ]);

        $ano_lectivo = AnoLectivo::where('ano_lectivo', $request->ano_lectivo)->first();
        if(!$ano_lectivo){
            return back()->with(['error'=>"Não encontrou este ano lectivo"]);
        }

        $forma_pagamento = FormaPagamento::where('forma_pagamento', $request->forma_pagamento)->first();
        $epocaPagamento = EpocaPagamento::where('id_forma_pagamento', $forma_pagamento->id)->get();
        $data = [
            'title' => "Balanços",
            'type' => "estatisticas",
            'menu' => "Balanços",
            'submenu' => "Gráfico",
            'getEpocasPagamento'=>$epocaPagamento,
            'getAno'=>$request->ano_lectivo,
        ];
        return view('graficos.balanco', $data);
    }
}
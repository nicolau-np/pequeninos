<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\EpocaPagamento;
use App\Estudante;
use App\FormaPagamento;
use App\HistoricEstudante;
use App\Pagamento;
use App\TabelaPreco;
use App\TipoPagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PagamentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_tipo_pagamento)
    {
        $data_pagos = [
            'epoca' => null,
        ];
        $data_nao_pagos = [
            'epoca'=>null,
        ];
        $data_epocas_pagamentos = [
            'epoca'=>null,
        ];
        $array_pagos = [];
        $array_nao_pagos = [];
        $array_epocas_pagamento = [];
        $id_historico = Session::get('id_historico');
        $historico = HistoricEstudante::find($id_historico);
        if (!$historico) {
            return back()->with(['error' => "Não encontrou historico"]);
        }

        $data = [
            'id_classe' => $historico->estudante->turma->classe->id,
            'id_curso' => $historico->estudante->turma->curso->id,
            'id_tipo_pagamento' => $id_tipo_pagamento,
        ];

        $tabela_preco = TabelaPreco::where($data)->first();
        if (!$tabela_preco) {
            return back()->with(['error' => "Não encontrou preco"]);
        }
        Session::put('id_tipo_pagamento', $id_tipo_pagamento);

        $forma_pagamento = FormaPagamento::where('forma_pagamento', $tabela_preco->forma_pagamento)->first();
        $epocas_pagemento = EpocaPagamento::where('id_forma_pagamento', $forma_pagamento->id)->get();

        $meses_pagos = Pagamento::where(['id_estudante' => $historico->id_estudante, 'ano_lectivo' => $historico->ano_lectivo])->get();

        //preencher o array de meses pagos
        foreach ($meses_pagos as $pagos) {
            $data_pagos['epoca'] = $pagos->epoca;
            array_push($array_pagos, $data_pagos);
        }
        //preencher o array de epocas de pagamento
        foreach($epocas_pagemento as $epocas){
           $data_epocas_pagamentos['epoca'] = $epocas->epoca;
           array_push($array_epocas_pagamento, $data_epocas_pagamentos);
        }
        
        $array_nao_pagos = array_diff_assoc($array_epocas_pagamento, $array_pagos);
        $data = [
            'title' => "Pagamentos",
            'type' => "pagamento",
            'menu' => "Estudantes",
            'submenu' => "Pagamentos",
            'getTabelaPreco' => $tabela_preco,
            'getHistoricoEstudante' => $historico,
            'getEpocasPagamento' => $epocas_pagemento,
            'getPagos' => $array_pagos,
            'getNaoPagos' => $array_nao_pagos,
        ];
        return view('pagamento.new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_user = Auth::user()->id;
        $id_historico = Session::get('id_historico');
        $id_tipo_pagamento = Session::get('id_tipo_pagamento');
        $historico = HistoricEstudante::find($id_historico);
        if (!$historico) {
            return back()->with(['error' => "Não encontrou historico"]);
        }
        $request->validate([
            'meses_a_pagar'=>['required'],
            'meses_a_pagar.*'=>['string']
        ]);

        $data = [
            'id_classe' => $historico->estudante->turma->classe->id,
            'id_curso' => $historico->estudante->turma->curso->id,
            'id_tipo_pagamento' => $id_tipo_pagamento,
        ];

        $tabela_preco = TabelaPreco::where($data)->first();
        if (!$tabela_preco) {
            return back()->with(['error' => "Não encontrou preco"]);
        }
        
        

        $data = [
        'id_tipo_pagamento',
        'id_usuario',
        'id_estudante',
        'epoca',
        'preco',
        'data_pagamento',
        'ano_lectivo',
        ];

        foreach($request->meses_a_pagar as $meses){
            echo $meses."<br/>";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listar($id_estudante, $ano)
    {
        $historicos = HistoricEstudante::orderBy('id', 'desc')->where('id_estudante', $id_estudante)->get();
        $historico = HistoricEstudante::where(['ano_lectivo' => $ano, 'id_estudante' => $id_estudante])->first();
        if (!$historico) {
            return back()->with(['error' => "Nao encontrou"]);
        }

        $data = [
            'id_classe' => $historico->estudante->turma->classe->id,
            'id_curso' => $historico->estudante->turma->curso->id,
        ];
        $tabela_preco = TabelaPreco::where($data)->get();
        Session::put('id_historico', $historico->id);
        $data = [
            'title' => "Pagamentos",
            'type' => "pagamento",
            'menu' => "Estudantes",
            'submenu' => "Pagamentos",
            'getHistoricoEstudante' => $historico,
            'getHistoricosEstudantes' => $historicos,
            'getTabelaPreco' => $tabela_preco,

        ];
        return view('pagamento.list', $data);
    }
}
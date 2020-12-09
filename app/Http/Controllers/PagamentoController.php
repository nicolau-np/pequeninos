<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\EpocaPagamento;
use App\Estudante;
use App\Fatura;
use App\FormaPagamento;
use App\HistoricEstudante;
use App\Pagamento;
use App\PagamentoPai;
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

        $array_pagos = [];
        $array_nao_pagos = [];
        $array_epocas_pagamento = [];
        $id_historico = Session::get('id_historico');
        $historico = HistoricEstudante::find($id_historico);
        if (!$historico) {
            return back()->with(['error' => "Não encontrou historico"]);
        }

        $data['tabela_preco'] = [
            'id_classe' => $historico->estudante->turma->classe->id,
            'id_curso' => $historico->estudante->turma->curso->id,
            'id_tipo_pagamento' => $id_tipo_pagamento,
        ];

        $tabela_preco = TabelaPreco::where($data['tabela_preco'])->first();
        if (!$tabela_preco) {
            return back()->with(['error' => "Não encontrou preco"]);
        }
        Session::put('id_tipo_pagamento', $id_tipo_pagamento);

        $forma_pagamento = FormaPagamento::where('forma_pagamento', $tabela_preco->forma_pagamento)->first();
        $epocas_pagemento = EpocaPagamento::where('id_forma_pagamento', $forma_pagamento->id)->get();
        $estudante = Estudante::find($historico->id_estudante);
        $educandos = Estudante::where('id_encarregado',$estudante->id_encarregado)->get();
        $data['pagamento'] = [
            'id_tipo_pagamento'=>$id_tipo_pagamento,
            'id_estudante' => $historico->id_estudante, 
            'ano_lectivo' => $historico->ano_lectivo,
        ];

        $data['pagamento_pai'] = [
            'id_tipo_pagamento'=>$id_tipo_pagamento,
            'id_encarregado' => $historico->estudante->id_encarregado, 
            'ano_lectivo' => $historico->ano_lectivo,
        ];
        
        //apagamento pai
        if($id_tipo_pagamento == 3){
            $meses_pagos = PagamentoPai::where($data['pagamento_pai'])->get();
        }else{
            //pagamento estudante
            $meses_pagos = Pagamento::where($data['pagamento'])->get();
        }
        
        //preencher o array de meses pagos
        foreach ($meses_pagos as $pagos) {
            array_push($array_pagos, $pagos->epoca);
        }
        //preencher o array de epocas de pagamento
        foreach ($epocas_pagemento as $epocas) {
            array_push($array_epocas_pagamento, $epocas->epoca);
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
            'getEstudante'=>$estudante,
            'getEducandos'=>$educandos,
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
            'meses_a_pagar' => ['required'],
            'meses_a_pagar.*' => ['string']
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
        $data['fatura'] = [
            'data_fatura'=>date('Y-m-d'),
            'ano'=>date('Y'),
        ];
        $fatura = Fatura::create($data['fatura']);
        $data['where'] = [
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'id_estudante' => $historico->id_estudante,
            'epoca' => null,
            'ano_lectivo' => $historico->ano_lectivo,
        ];
        
         $data['store'] = [
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'id_usuario' => $id_user,
            'id_estudante' => $historico->id_estudante,
            'epoca' => null,
            'preco' => $tabela_preco->preco,
            'data_pagamento' => date('Y-m-d'),
            'fatura'=>$fatura->id,
            'ano_lectivo' => $historico->ano_lectivo,   
        ];

        $data['where_pai'] = [
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'id_encarregado' => $historico->estudante->id_encarregado,
            'epoca' => null,
            'ano_lectivo' => $historico->ano_lectivo,
        ];

        $data['store_pai'] = [
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'id_usuario' => $id_user,
            'id_encarregado' => $historico->estudante->id_encarregado,
            'epoca' => null,
            'preco' => $tabela_preco->preco,
            'data_pagamento' => date('Y-m-d'),
            'fatura'=>$fatura->id,
            'ano_lectivo' => $historico->ano_lectivo, 
        ];

        //apagamento pai
        if($id_tipo_pagamento == 3){
            foreach ($request->meses_a_pagar as $epoca) {
                $data['store_pai']['epoca'] = $epoca;
                $data['where_pai']['epoca'] = $epoca;
                if(!PagamentoPai::where($data['where_pai'])->first()){
                    $pagamento = PagamentoPai::create($data['store_pai']);
                }
            } 
        }else{
            //pagamento estudante
            foreach ($request->meses_a_pagar as $epoca) {
            $data['store']['epoca'] = $epoca;
            $data['where']['epoca'] = $epoca;
            if(!Pagamento::where($data['where'])->first()){
                $pagamento = Pagamento::create($data['store']);
            }
            }
        }
        
        if ($pagamento) {
            return back()->with(['success' => "Feito com sucesso"]);
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
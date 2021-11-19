<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\EpocaPagamento;
use App\Estudante;
use App\Fatura;
use App\FormaPagamento;
use App\HistoricEstudante;
use App\Multado;
use App\Pagamento;
use App\PagamentoPai;
use App\TabelaPreco;
use App\TipoPagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PagamentoController extends Controller
{

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
            'id_turno' => $historico->estudante->turma->id_turno,
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
        $educandos = Estudante::where('id_encarregado', $estudante->id_encarregado)->get();
        $data['pagamento'] = [
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'id_estudante' => $historico->id_estudante,
            'ano_lectivo' => $historico->ano_lectivo,
        ];

        $data['pagamento_pai'] = [
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'id_encarregado' => $historico->estudante->id_encarregado,
            'ano_lectivo' => $historico->ano_lectivo,
        ];

        //apagamento pai
        if ($id_tipo_pagamento == 3) {
            $meses_pagos = PagamentoPai::where($data['pagamento_pai'])->get();
        } else {
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

        if ($forma_pagamento->forma_pagamento == "Necessidade") {
            //$array_nao_pagos = array_diff_assoc($array_epocas_pagamento, $array_pagos);
            $array_nao_pagos = $array_epocas_pagamento;
        } else {
            $array_nao_pagos = array_diff_assoc($array_epocas_pagamento, $array_pagos);
        }


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
            'getEstudante' => $estudante,
            'getEducandos' => $educandos,
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
            'meses_a_pagar.*' => ['string'],
            'data_entrada' => ['required', 'date'],
        ]);

        $data = [
            'id_classe' => $historico->estudante->turma->classe->id,
            'id_curso' => $historico->estudante->turma->curso->id,
            'id_turno' => $historico->estudante->turma->id_turno,
            'id_tipo_pagamento' => $id_tipo_pagamento,

        ];

        $tabela_preco = TabelaPreco::where($data)->first();
        if (!$tabela_preco) {
            return back()->with(['error' => "Não encontrou preco"]);
        }
        $data['fatura'] = [
            'data_fatura' => date('Y-m-d'),
            'ano' => date('Y'),
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
            'data_pagamento' => $request->data_entrada,
            'fatura' => $fatura->id,
            'mes_pagamento' => date('m', strtotime($request->data_entrada)),
            'descricao' => $request->descricao,
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
            'data_pagamento' => $request->data_entrada,
            'fatura' => $fatura->id,
            'mes_pagamento' => date('m', strtotime($request->data_entrada)),
            'ano_lectivo' => $historico->ano_lectivo,
        ];

        $data['multa'] = [
            'id_estudante' => $historico->id_estudante,
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'mes' => null,
            'estado' => "on",
            'ano_lectivo' => $historico->ano_lectivo,
        ];

        //apagamento pai
        if ($id_tipo_pagamento == 3) {
            foreach ($request->meses_a_pagar as $epoca) {
                $data['store_pai']['epoca'] = $epoca;
                $data['where_pai']['epoca'] = $epoca;
                if (!PagamentoPai::where($data['where_pai'])->first()) {
                    $pagamento = PagamentoPai::create($data['store_pai']);
                }
            }
        } else {
            if ($tabela_preco->forma_pagamento == "Necessidade") {
                //se a forma de pagamento for por necessidade
                foreach ($request->meses_a_pagar as $epoca) {
                    $data['store']['epoca'] = $epoca;
                    $data['where']['epoca'] = $epoca;
                    $data['multa']['mes'] = $epoca;

                    /**caso ja tenha feito o pagamento */

                    $pagamento = Pagamento::create($data['store']);
                    if (Multado::where($data['multa'])->first()) {
                        Multado::where($data['multa'])->update(['estado' => "off"]);
                    }
                }
            } elseif ($tabela_preco->forma_pagamento == "Mensal") {
                //caso contrario
                //pagamento estudante

                foreach ($request->meses_a_pagar as $epoca) {
                    $data['store']['epoca'] = $epoca;
                    $data['where']['epoca'] = $epoca;
                    $data['multa']['mes'] = $epoca;

                    if ($epoca != "Setembro") {


                        /**pegar o id da epoca */
                        $epocasPagamento = EpocaPagamento::where(['epoca' => $epoca])->first();
                        /*criar mes anterior*/
                        $id_mes_anterior = $epocasPagamento->id - 1;
                        /*levar o numero do mes anterior e trazer a resposta */
                        $epocasPagamento_anterior = EpocaPagamento::find($id_mes_anterior);

                        /**verifica se já pagou o mes anterior*/
                        if (!Pagamento::where([
                            'id_tipo_pagamento' => $id_tipo_pagamento,
                            'id_estudante' => $historico->id_estudante,
                            'epoca' => $epocasPagamento_anterior->epoca,
                            'ano_lectivo' => $historico->ano_lectivo,
                        ])->first()) {
                            return back()->with(['error' => "Não pagou os mês anterior a este que pretende pagar"]);
                        }
                    }

                    /**caso ja tenha feito o pagamento */
                    if (!Pagamento::where($data['where'])->first()) {
                        $pagamento = Pagamento::create($data['store']);
                        if (Multado::where($data['multa'])->first()) {
                            Multado::where($data['multa'])->update(['estado' => "off"]);
                        }
                    }
                }
            } else {

                //caso contrario
                //pagamento estudante

                foreach ($request->meses_a_pagar as $epoca) {
                    $data['store']['epoca'] = $epoca;
                    $data['where']['epoca'] = $epoca;
                    $data['multa']['mes'] = $epoca;


                    /**caso ja tenha feito o pagamento */
                    $pag = Pagamento::where([
                        'id_estudante' => $historico->id_estudante,
                        'id_tipo_pagamento' => $id_tipo_pagamento,
                        'epoca' => $epoca,
                        'ano_lectivo' => $historico->ano_lectivo,
                    ])->first();
                    if (!$pag) {
                        $pagamento = Pagamento::create($data['store']);
                        if (Multado::where($data['multa'])->first()) {
                            Multado::where($data['multa'])->update(['estado' => "off"]);
                        }
                    }
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
    public function show(Request $request)
    {
        $id_historico = Session::get('id_historico');
        $id_tipo_pagamento = Session::get('id_tipo_pagamento');
        $historico = HistoricEstudante::find($id_historico);
        if (!$historico) {
            return back()->with(['error' => "Não encontrou historico"]);
        }

        $data['where_pai'] = [
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'id_encarregado' => $historico->estudante->id_encarregado,
            'epoca' => $request->epoca,
            'ano_lectivo' => $historico->ano_lectivo,
        ];

        $data['where_estudante'] = [
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'id_estudante' => $historico->id_estudante,
            'epoca' => $request->epoca,
            'ano_lectivo' => $historico->ano_lectivo,
        ];

        if ($id_tipo_pagamento == 3) {
            $pagamento = PagamentoPai::where($data['where_pai'])->first();
        } else {
            $pagamento = Pagamento::where($data['where_estudante'])->first();
        }

        $data = [
            'getPagamentoDetails' => $pagamento,
        ];

        return view('ajax_loads.getPagamentoDetails', $data);
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
    public function update(Request $request)
    {
        $request->validate([

            'data_pagamento' => ['required', 'date'],
            'id_estudante' => ['required', 'integer'],
            'factura' => ['required', 'integer'],
            'ano_lectivo' => ['required', 'string'],
            'id_tipo_pagamento' => ['required', 'integer'],
        ]);

        $data['where'] = [
            'id_tipo_pagamento' => $request->id_tipo_pagamento,
            'id_estudante' => $request->id_estudante,
            'fatura' => $request->factura,
            'ano_lectivo' => $request->ano_lectivo,
        ];

        $data['update'] = [
            'data_pagamento' => $request->data_pagamento,
            'descricao' => $request->descricaoT,
        ];

        if (Pagamento::where($data['where'])->update($data['update'])) {
            return back()->with(['success' => "Informação actualizada com sucesso"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id_tipo_pagamento' => ['required', 'integer', 'min:1'],
            'id_estudante' => ['required', 'integer', 'min:1'],
            'factura' => ['required', 'integer', 'min:1'],
            'ano_lectivo' => ['required', 'string',],
        ]);
        $pagamento = Pagamento::where(['id_estudante' => $request->id_estudante, 'fatura' => $request->factura, 'ano_lectivo' => $request->ano_lectivo])->first();
        if (!$pagamento) {
            return back()->with(['error' => "Não encontrou factura"]);
        }

        /**verificar forma de pagamento */
        $tabela_preco = TabelaPreco::where(['id_tipo_pagamento' => $request->id_tipo_pagamento])->first();

        /**end */
        if ($tabela_preco->forma_pagamento != "Necessidade") {
            /**pegar pagamentos feitos */
            $pagamentos_feitos = Pagamento::where([
                'id_tipo_pagamento' => $request->id_tipo_pagamento,
                'id_estudante' => $request->id_estudante,
                'ano_lectivo' => $request->ano_lectivo
            ])->get();

            foreach ($pagamentos_feitos as $pags) {
                if ($pags->fatura  > $pagamento->fatura) {
                    return back()->with(['error' => "Deve eliminar do último ao primeiro"]);
                }
            }
        }

        if (Pagamento::where(['id_estudante' => $request->id_estudante, 'fatura' => $request->factura, 'ano_lectivo' => $request->ano_lectivo])->delete()) {
            return back()->with(['success' => "Eliminou pagamento com sucesso"]);
        }
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
            'id_turno' => $historico->estudante->turma->id_turno,
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

    public function mapas(){
        $data = [
            'title' => "Pagamentos efectuados",
            'type' => "mapa",
            'menu' => "Pagamentos",
            'submenu' => "Mapa",
        ];
        return view('pagamento.mapas', $data);
    }

}
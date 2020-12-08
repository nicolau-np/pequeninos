<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Estudante;
use App\HistoricEstudante;
use App\TabelaPreco;
use App\TipoPagamento;
use Illuminate\Http\Request;

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
    public function index($id_estudante, $ano)
    {
      
        $anos_lectivos = AnoLectivo::orderBy('id', 'desc')->pluck('ano_lectivo', 'id');
        $historico = HistoricEstudante::where(['ano_lectivo'=>$ano, 'id_estudante'=>$id_estudante])->first();
        if(!$historico){
            return back()->with(['error'=>"Nao encontrou"]);
        }
       
        $ano_lectivo = AnoLectivo::where('ano_lectivo', $ano)->first();
        
        $data = [
            'id_classe'=>$historico->turma->classe->id_classe,
            'id_curso'=>$historico->turma->curso->id_curso,
        ];
        $tabela_preco = TabelaPreco::where($data)->get();
        $data = [
            'title'=>"Pagamentos",
            'type'=>"pagamento",
            'menu'=>"Estudantes",
            'submenu'=>"Pagamentos",
            'getHistoricoEstudante'=>$historico,
            'getTabelaPreco'=>$tabela_preco,
            'getAnos'=>$anos_lectivos,
            'getAno'=>$ano_lectivo,
        ];
        return view('pagamento.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_estudante)
    {
        $estudante = Estudante::find($id_estudante);
        if(!$estudante){
            return back()->with(['error'=>"Não está confirmado para este Ano"]);
        }
        $tipo_pagamentos = TipoPagamento::pluck('tipo', 'id');
        $data = [
            'title'=>"Pagamentos",
            'type'=>"pagamento",
            'menu'=>"Estudantes",
            'submenu'=>"Pagamentos",
            'getEstudante'=>$estudante,
            'getTipPagamentos'=>$tipo_pagamentos,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'id_estudante'=>['required', 'Integer'],
            'ano_lectivo'=>['required', 'Integer']
        ]);
        $getAno = AnoLectivo::find($request->ano_lectivo);
        $anos_lectivos = AnoLectivo::orderBy('id', 'desc')->pluck('ano_lectivo', 'id');
        $historico = HistoricEstudante::where(['ano_lectivo'=>$getAno->ano_lectivo, 'id_estudante'=>$request->id_estudante])->first();
        if(!$historico){
            return back()->with(['error'=>"Não está confirmado para este Ano"]);
        }
       
        $ano_lectivo = AnoLectivo::where('ano_lectivo', $getAno->ano_lectivo)->first();
        
        $data = [
            'id_classe'=>$historico->turma->classe->id_classe,
            'id_curso'=>$historico->turma->curso->id_curso,
        ];
        $tabela_preco = TabelaPreco::where($data)->get();
        $data = [
            'title'=>"Pagamentos",
            'type'=>"pagamento",
            'menu'=>"Estudantes",
            'submenu'=>"Pagamentos",
            'getHistoricoEstudante'=>$historico,
            'getTabelaPreco'=>$tabela_preco,
            'getAnos'=>$anos_lectivos,
            'getAno'=>$ano_lectivo,
        ];
        return view('pagamento.list', $data);
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
}
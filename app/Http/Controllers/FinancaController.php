<?php

namespace App\Http\Controllers;

use App\Curso;
use App\TabelaPreco;
use App\TipoPagamento;
use Illuminate\Http\Request;

class FinancaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function tabela_preco_list()
    {
        $tabela_precos = TabelaPreco::paginate(5);
        $data = [
            'title' => "Tabela de Preços",
            'type' => "financas",
            'menu' => "Tabela de Preços",
            'submenu' => "Listar",
            'getTabela_preco' => $tabela_precos,
        ];
        return view('financas.tabela_preco.list', $data);
    }

    public function tabela_preco_create()
    {
        $tipo_pagamentos = TipoPagamento::pluck('tipo', 'id');
        $cursos = Curso::pluck('curso', 'id');

        $data = [
            'title' => "Tabela de Preços",
            'type' => "financas",
            'menu' => "Tabela de Preços",
            'submenu' => "Novo",
            'getTipoPagamentos' => $tipo_pagamentos,
            'getCursos' => $cursos,
        ];
        return view('financas.tabela_preco.new', $data);
    }

    public function tabela_preco_store(Request $request)
    {
        $request->validate([
            'tipo_pagamento' => ['required', 'Integer'],
            'curso' => ['required', 'Integer'],
            'classe' => ['required', 'integer'],
            'preco' => ['required', 'numeric'],
            'forma_pagamento'=>['required', 'string']
        ]);

        $data = [
            'id_tipo_pagamento'=>$request->tipo_pagamento,
            'id_curso'=>$request->curso,
            'id_classe'=>$request->classe,
            'preco'=>$request->preco,
            'forma_pagamento'=>$request->forma_pagamento
        ];

        if(TabelaPreco::where($data)->first()){
            return back()->with(['error'=>"Já cadastrou este"]);
        }

        if(TabelaPreco::create($data)){
            return back()->with(['success'=>"Feito com sucesso"]);
        }
    }

    public function tabela_preco_edit($id)
    {
        $tabela_preco = TabelaPreco::find($id);
        if(!$tabela_preco){
            return back()->with(['error'=>"Não encontrou"]);
        }

        $tipo_pagamentos = TipoPagamento::pluck('tipo', 'id');
        $cursos = Curso::pluck('curso', 'id');

        $data = [
            'title' => "Tabela de Preços",
            'type' => "financas",
            'menu' => "Tabela de Preços",
            'submenu' => "Novo",
            'getTipoPagamentos' => $tipo_pagamentos,
            'getCursos' => $cursos,
            'getTabela_preco'=>$tabela_preco,
        ];
        return view('financas.tabela_preco.edit', $data);
        
    }

    public function tabela_preco_update(Request $request, $id)
    {
        $tabela_preco = TabelaPreco::find($id);
        if(!$tabela_preco){
            return back()->with(['error'=>"Não encontrou"]);
        }
        
        $request->validate([
            'tipo_pagamento' => ['required', 'Integer'],
            'curso' => ['required', 'Integer'],
            'classe' => ['required', 'integer'],
            'preco' => ['required', 'numeric'],
            'forma_pagamento'=>['required', 'string']
        ]);

        $data = [
            'id_tipo_pagamento'=>$request->tipo_pagamento,
            'id_curso'=>$request->curso,
            'id_classe'=>$request->classe,
            'preco'=>$request->preco,
            'forma_pagamento'=>$request->forma_pagamento
        ];

        if($request->tipo_pagamento!=$tabela_preco->id_tipo_pagamento || $request->curso!=$tabela_preco->id_curso 
        || $request->classe!=$tabela_preco->id_classe || $request->preco!=$tabela_preco->preco 
        || $request->forma_pagamento!=$tabela_preco->forma_pagamento){
            if(TabelaPreco::where($data)->first()){
            return back()->with(['error'=>"Já cadastrou este"]);
            }
        }
        

        if(TabelaPreco::find($id)->update($data)){
            return back()->with(['success'=>"Feito com sucesso"]);
        }
    }
}
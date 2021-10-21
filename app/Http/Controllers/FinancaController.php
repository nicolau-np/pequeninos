<?php

namespace App\Http\Controllers;

use App\Curso;
use App\TabelaPreco;
use App\TipoPagamento;
use App\Turno;
use Illuminate\Http\Request;

class FinancaController extends Controller
{


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
        $turnos = Turno::pluck('turno', 'id');

        $data = [
            'title' => "Tabela de Preços",
            'type' => "financas",
            'menu' => "Tabela de Preços",
            'submenu' => "Novo",
            'getTipoPagamentos' => $tipo_pagamentos,
            'getCursos' => $cursos,
            'getTurnos' => $turnos,
        ];
        return view('financas.tabela_preco.new', $data);
    }

    public function tabela_preco_store(Request $request)
    {
        $request->validate([
            'tipo_pagamento' => ['required', 'Integer'],
            'curso' => ['required', 'Integer'],
            'preco' => ['required', 'numeric'],
            'forma_pagamento' => ['required', 'string'],
            'turno' => ['required', 'Integer'],
            'classe' => ['required'],
            'classe.*' => ['string']
        ]);

        $tipo_pagamento = TipoPagamento::find($request->tipo_pagamento);
        if (!$tipo_pagamento) {
            return back()->with(['error' => "Nao encontrou tipo de pagamento"]);
        }

        if ($tipo_pagamento->multa == "sim") {
            $request->validate([
                'percentagem_multa' => ['required', 'integer', 'min:1'],
            ]);
        }

        $data = [
            'id_tipo_pagamento' => $request->tipo_pagamento,
            'id_curso' => $request->curso,
            'id_classe' => null,
            'id_turno' => $request->turno,
            'preco' => $request->preco,
            'forma_pagamento' => $request->forma_pagamento,
            'percentagem_multa' => $request->percentagem_multa,
        ];

        $data2 = [
            'id_tipo_pagamento' => $request->tipo_pagamento,
            'id_curso' => $request->curso,
            'id_classe' => null,
            'id_turno' => $request->turno,
            'forma_pagamento' => $request->forma_pagamento,
        ];


        $tabela = false;
        foreach ($request->classe as $classe) {
            $data['id_classe'] = $classe;
            $data2['id_classe'] = $classe;
            if (!TabelaPreco::where($data)->first()) {
                if (!TabelaPreco::where($data2)->first()) {
                    $tabela = TabelaPreco::create($data);
                }
            }
        }

        if ($tabela) {
            return back()->with(['success' => "Feito com sucesso"]);
        } else {
            return back()->with(['error' => "Já Cadastrou"]);
        }
    }

    public function tabela_preco_edit($id)
    {
        $tabela_preco = TabelaPreco::find($id);
        if (!$tabela_preco) {
            return back()->with(['error' => "Não encontrou"]);
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
            'getTabela_preco' => $tabela_preco,
        ];
        return view('financas.tabela_preco.edit', $data);
    }

    public function tabela_preco_update(Request $request, $id)
    {
        $tabela_preco = TabelaPreco::find($id);
        if (!$tabela_preco) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $request->validate([
            'tipo_pagamento' => ['required', 'Integer'],
            'curso' => ['required', 'Integer'],
            'classe' => ['required', 'integer'],
            'preco' => ['required', 'numeric'],
            'forma_pagamento' => ['required', 'string']
        ]);

        $tipo_pagamento = TipoPagamento::find($request->tipo_pagamento);
        if (!$tipo_pagamento) {
            return back()->with(['error' => "Nao encontrou tipo de pagamento"]);
        }

        if ($tipo_pagamento->multa == "sim") {
            $request->validate([
                'percentagem_multa' => ['required', 'integer', 'min:1'],
            ]);
        }

        $data = [
            'id_tipo_pagamento' => $request->tipo_pagamento,
            'id_curso' => $request->curso,
            'id_classe' => $request->classe,
            'preco' => $request->preco,
            'forma_pagamento' => $request->forma_pagamento,
            'percentagem_multa' => $request->percentagem_multa,
        ];

        if (
            $request->tipo_pagamento != $tabela_preco->id_tipo_pagamento || $request->curso != $tabela_preco->id_curso
            || $request->classe != $tabela_preco->id_classe || $request->preco != $tabela_preco->preco
            || $request->forma_pagamento != $tabela_preco->forma_pagamento || $request->percentagem_multa != $tabela_preco->percentagem_multa
        ) {
            if (TabelaPreco::where($data)->first()) {
                return back()->with(['error' => "Já cadastrou este"]);
            }
        }


        if (TabelaPreco::find($id)->update($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function tipo_pagamento_list()
    {
        $tipo_pagamentos = TipoPagamento::paginate(5);
        $data = [
            'title' => "Tipo de Pagamentos",
            'type' => "financas",
            'menu' => "Tipo de Pagamentos",
            'submenu' => "Listar",
            'getTipoPagamentos' => $tipo_pagamentos,
        ];
        return view('financas.tipo_pagamento.list', $data);
    }

    public function tipo_pagamento_create()
    {
        $data = [
            'title' => "Tipo de Pagamentos",
            'type' => "financas",
            'menu' => "Tipo de Pagamentos",
            'submenu' => "Novo",
        ];
        return view('financas.tipo_pagamento.new', $data);
    }

    public function tipo_pagamento_store(Request $request)
    {
        $request->validate([
            'tipo_pagamento' => ['required', 'string', 'min:5', 'max:255', 'unique:tipo_pagamentos,tipo'],
            'multa' => ['required', 'string', 'min:3'],
        ]);

        if($request->multa == "sim"){
            $request->validate([
                'dia_cobranca_multa'=> ['required', 'integer', 'min:1', 'max:31'],
            ]);
        }

        $data = [
            'tipo' => $request->tipo_pagamento,
        ];

        if (TipoPagamento::create($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function tipo_pagamento_edit($id)
    {
        $tipo_pagamento = TipoPagamento::find($id);
        if (!$tipo_pagamento) {
            return back()->with(['error' => "Nao encontrou"]);
        }

        $data = [
            'title' => "Tipo de Pagamentos",
            'type' => "financas",
            'menu' => "Tipo de Pagamentos",
            'submenu' => "Editar",
            'getTipoPagamento' => $tipo_pagamento,
        ];
        return view('financas.tipo_pagamento.edit', $data);
    }

    public function tipo_pagamento_update(Request $request, $id)
    {
        $tipo_pagamento = TipoPagamento::find($id);
        if (!$tipo_pagamento) {
            return back()->with(['error' => "Nao encontrou"]);
        }

        $data = [
            'tipo' => $request->tipo_pagamento,
        ];

        if ($request->tipo_pagamento != $tipo_pagamento->tipo) {
            if (TipoPagamento::where('tipo', $data['tipo'])->first()) {
                return back()->with(['error' => "Já cadastrou"]);
            }
        }

        if (TipoPagamento::find($tipo_pagamento->id)->update($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }
}
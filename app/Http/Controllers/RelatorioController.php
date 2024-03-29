<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\CadeiraExame;
use App\CadeiraRecurso;
use App\CategoriaEstudante;
use App\Classe;
use App\Curso;
use App\Declaracao;
use App\DirectorTurma;
use App\Disciplina;
use App\Encarregado;
use App\Ensino;
use App\EpocaPagamento;
use App\Estudante;
use App\Fatura;
use App\FormaPagamento;
use App\Funcionario;
use App\HistoricEstudante;
use App\Horario;
use App\OrdernaDisciplina;
use App\Pagamento;
use App\PagamentoPai;
use App\Saida;
use App\TabelaPreco;
use App\TipoPagamento;
use App\Transferencia;
use App\Turma;
use App\Turno;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class RelatorioController extends Controller
{

    public function fatura($id_fatura)
    {

        $fatura = Fatura::find($id_fatura);
        if (!$fatura) {
            return back()->with(['error' => "Não encontrou numero da fatura"]);
        }
        $id_historico = Session::get('id_historico');
        $id_tipo_pagamento = Session::get('id_tipo_pagamento');
        $historico = HistoricEstudante::find($id_historico);
        if (!$historico) {
            return back()->with(['error' => "Não encontrou historico"]);
        }
        $tipo_pagamento = TipoPagamento::find($id_tipo_pagamento);
        if ($id_tipo_pagamento == 3) {
            $pagamento = PagamentoPai::where('fatura', $id_fatura)->get();
        } else {
            $pagamento = Pagamento::where('fatura', $id_fatura)->get();
        }
        $educandos = Estudante::where('id_encarregado', $historico->estudante->id_encarregado)->get();
        $tabela_preco = TabelaPreco::where([
            'id_tipo_pagamento' => $id_tipo_pagamento,
            'id_curso' => $historico->turma->id_curso,
            'id_classe' => $historico->turma->id_classe,
            'id_turno' => $historico->turma->id_turno,

        ])->first();
        $getRecordPagamento = Pagamento::where(['fatura' => $id_fatura, 'ano_lectivo' => $historico->ano_lectivo, 'id_estudante' => $historico->id_estudante])->first();

        $data = [
            'getPagamento' => $pagamento,
            'getHistorico' => $historico,
            'getId_tipo_pagamento' => $id_tipo_pagamento,
            'getTipoPagamento' => $tipo_pagamento,
            'getFatura' => $fatura,
            'getEducandos' => $educandos,
            'getTabelaPreco' => $tabela_preco,
            'getRecordPagamento' => $getRecordPagamento,
        ];
        $pdf = PDF::loadView('relatorios.fatura', $data)->setPaper('A4', 'normal');

        return $pdf->stream('fatura' . $id_fatura . '-' . date('Y') . '.pdf');
    }

    public function lista_pagamentos(Request $request)
    {
        $request->validate([
            'tipo_pagamento' => ['required', 'Integer'],
            'curso' => ['required', 'Integer'],
            'classe' => ['required', 'Integer'],
            'turma' => ['required', 'Integer'],
            'ano_lectivo' => ['required', 'string', 'max:255'],
        ]);

        $tipo_pagamento = TipoPagamento::find($request->tipo_pagamento);
        if (!$tipo_pagamento) {
            return back()->with(['error' => "Não encontrou pagamento"]);
        }

        $turma = Turma::find($request->turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $ano_lectivo = AnoLectivo::where('ano_lectivo', $request->ano_lectivo)->first();
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou este ano lectivo"]);
        }
        $data['where'] = [
            'id_curso' => $request->curso,
            'id_classe' => $request->classe,
            'id_tipo_pagamento' => $request->tipo_pagamento,
        ];
        $tabela_preco = TabelaPreco::where($data['where'])->first();
        if (!$tabela_preco) {
            return back()->with(['error' => "Não existe este pagamento"]);
        }
        $forma_pagamentos = FormaPagamento::where('forma_pagamento', $tabela_preco->forma_pagamento)->first();
        $epoca_pagamentos = EpocaPagamento::where('id_forma_pagamento', $forma_pagamentos->id)->get();
        $historico = HistoricEstudante::where(['id_turma' => $request->turma, 'ano_lectivo' => $request->ano_lectivo])
            ->orderBy('numero', 'asc')->get();
        $data = [
            'getTipoPagamento' => $tipo_pagamento,
            'getTurma' => $turma,
            'getAno' => $request->ano_lectivo,
            'getTabelaPreco' => $tabela_preco,
            'getEpocasPagamento' => $epoca_pagamentos,
            'getHistoricoEstudante' => $historico,

        ];
        $pdf = PDF::loadView('relatorios.lista_pagamento', $data)->setPaper('A4', 'landscape');

        return $pdf->stream('LISTA DE ' . strtoupper($tipo_pagamento->tipo) . '-' . $request->ano_lectivo . '[ ' . strtoupper($turma->turma) . ' - ' . $turma->turno->turno . ' - ' . $turma->curso->curso . ' ].pdf');
    }

    public function lista_comparticipacao(Request $request)
    {
        $request->validate([
            'ano_lectivo' => ['required', 'string', 'max:255'],
        ]);
        $ano_lectivo = AnoLectivo::find($request->ano_lectivo);
        if (!$ano_lectivo) {
            return back()->with(['error' => "Ano lectivo não encontrado"]);
        }

        $encarregados = Encarregado::get()->sortBy('pessoa.nome');

        $data = [
            'getAno' => $ano_lectivo,
            'getEncarregados' => $encarregados,
        ];
        $pdf = PDF::loadView('relatorios.lista_encarregados', $data)->setPaper('A4', 'normal');

        return $pdf->stream('LISTA DE ENCARREGADOS - ' . $ano_lectivo->ano_lectivo . '.pdf');
    }

    public function lista_nominal($id_turma, $ano_lectivo)
    {
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $historico = HistoricEstudante::whereHas('estudante.pessoa', function () {
        })->where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])
            ->orderBy('numero', 'asc')->get();
        $data = [
            'getHistorico' => $historico,
            'getAno' => $ano_lectivo,
            'getTurma' => $turma,
        ];
        $pdf = PDF::loadView('relatorios.lista_nominal', $data)->setPaper('A4', 'normal');

        return $pdf->stream('LISTA NOMINAL ' . $ano_lectivo . '[ ' . strtoupper($turma->turma) . ' - ' . strtoupper($turma->turno->turno) . ' - ' . strtoupper($turma->curso->curso) . ' ].pdf');
    }

    public function minipauta($id_turma, $id_disciplina, $ano_lectivo)
    {

        $anos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$anos) {
            return back()->with(['error' => "Ano Lectivo não encontrado"]);
        }

        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Turma não encontrada"]);
        }

        $disciplina = Disciplina::find($id_disciplina);
        if (!$disciplina) {
            return back()->with(['error' => "Não encontrou disciplina"]);
        }

        if (Session::has('id_funcionario')) {
            //verificando horario e funcionario
            $data['where_horario'] = [
                'id_funcionario' => Session::get('id_funcionario'),
                'id_turma' => $id_turma,
                'id_disciplina' => $id_disciplina,
                'ano_lectivo' => $ano_lectivo,
                'estado' => "visivel"
            ];

            $horario = Horario::where($data['where_horario'])->first();
            if (!$horario) {
                return back()->with(['error' => "Não é professor desta turma"]);
            }
        } else {
            return back()->with(['error' => "Deve iniciar sessão"]);
        }

        $historico = HistoricEstudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])
            ->orderBy('numero', 'asc')->get();


        //verificar se e uma cadeira de recursos
        $cadeira_recurso = false;
        $cadeira_recurso = CadeiraRecurso::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
            'id_disciplina' => $id_disciplina,
            'estado' => "on",
        ])->first();

        //verificar cadeiras que tem exame
        $cadeira_exame = false;
        $cadeira_exame = CadeiraExame::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
            'id_disciplina' => $id_disciplina,
            'estado' => "on",
        ])->first();


        $data['view'] = [
            'getHorario' => $horario,
            'getHistorico' => $historico,
            'getCadeiraRecurso' => $cadeira_recurso,
            'getCadeiraExame' => $cadeira_exame,
        ];

        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;

        if ($id_ensino == 1) { //iniciacao ate 6
            //se for classificacao quantitativa
            if (($classe == "2ª classe") || ($classe == "4ª classe") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe") || ($classe == "Módulo 2") || ($classe == "Módulo 1")) {
                $pdf = PDF::loadView('minipauta.pdf.ensino_primario_2_4_copy', $data['view'])->setPaper('A4', 'normal');
            } //se for classificacao quantitativa
            elseif (($classe == "Iniciação")) {
                $pdf = PDF::loadView('minipauta.pdf.ensino_primario_Ini_1_3_5_copy', $data['view'])->setPaper('A4', 'normal');
            } elseif (($classe == "6ª classe") || ($classe == "Módulo 3")) {
                $pdf = PDF::loadView('minipauta.pdf.ensino_primario_6_copy', $data['view'])->setPaper('A4', 'normal');
            }
        } elseif ($id_ensino == 2) { //7 classe ate 9 ensino geral
            if ($classe == "9ª classe") {
                $pdf = PDF::loadView('minipauta.pdf.ensino_1ciclo_9_copy', $data['view'])->setPaper('A4', 'normal');
            } else {
                $pdf = PDF::loadView('minipauta.pdf.ensino_1ciclo_7_8_copy', $data['view'])->setPaper('A4', 'normal');
            }
        }
        return $pdf->stream('MINI-PAUTA ' . $ano_lectivo . '[' . strtoupper($turma->turma) . ' ' . strtoupper($turma->turno->turno) . '-' . strtoupper($turma->curso->curso) . '-' . strtoupper($horario->disciplina->disciplina) . '].pdf');
    }


    public function pauta($id_turma, $ano_lectivo)
    {
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $ano_lecti = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lecti) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $id_pessoa = Auth::user()->pessoa->id;
        //se for administrador
        if ((Auth::user()->nivel_acesso == "admin") || (Auth::user()->nivel_acesso == "user")) {
            $directorTurma = DirectorTurma::where([
                'id_turma' => $id_turma,
                'ano_lectivo' => $ano_lectivo,
            ])->first();

            if (!$directorTurma) {
                return back()->with(['error' => "Não é Director desta turma"]);
            }
        } else {
            $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
            if (!$funcionario) {
                return back()->with(['error' => "Não encontrou funcionario"]);
            }

            if (Auth::user()->nivel_acesso == "professor") {
                $directorTurma = DirectorTurma::where([
                    'id_funcionario' => $funcionario->id,
                    'id_turma' => $id_turma,
                    'ano_lectivo' => $ano_lectivo,
                ])->first();

                if (!$directorTurma) {
                    return back()->with(['error' => "Não é Director desta turma"]);
                }
            }
        }

        //verificar se selecionou a ordem das disciplinas
        $ordena_disciplina = null;
        if (!Session::has('disciplinas')) {
            $ordena_disciplina = OrdernaDisciplina::where(['id_curso' => $turma->id_curso, 'id_classe' => $turma->id_classe])->get();
        }

        $historico = HistoricEstudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])
            ->orderBy('numero', 'asc')->get();

        $data['view'] = [
            'getDirector' => $directorTurma,
            'getHistorico' => $historico,
            'getOrdenaDisciplinas' => $ordena_disciplina,
        ];

        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;


        if ($id_ensino == 1) { //iniciacao ate 6
            //se for classificacao quantitativa
            if (($classe == "2ª classe") || ($classe == "4ª classe") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe") || ($classe == "Módulo 2") || ($classe == "Módulo 1")) {
                $pdf = PDF::loadView('pauta.pdf.ensino_primario_2_4_copy', $data['view'])->setPaper('A3', 'landscape');
            } //se for classificacao quantitativa
            elseif (($classe == "Iniciação")) {
                $pdf = PDF::loadView('pauta.pdf.ensino_primario_Ini_1_3_5_copy', $data['view'])->setPaper('A3', 'landscape');
            } elseif (($classe == "6ª classe") || ($classe == "Módulo 3")) {
                $pdf = PDF::loadView('pauta.pdf.ensino_primario_6_copy', $data['view'])->setPaper('A3', 'landscape');
            }
        } elseif ($id_ensino == 2) { //7 classe ate 9 ensino geral
            if ($classe == "9ª classe") {
                $pdf = PDF::loadView('pauta.pdf.ensino_1ciclo_9_copy', $data['view'])->setPaper('A3', 'landscape');
            } else {
                $pdf = PDF::loadView('pauta.pdf.ensino_1ciclo_7_8_copy', $data['view'])->setPaper('A3', 'landscape');
            }
        }
        return $pdf->stream('PAUTA ' . $ano_lectivo . '[ ' . strtoupper($turma->turma) . ' ' . strtoupper($turma->turno->turno) . '-' . strtoupper($turma->curso->curso) . ' ].pdf');
    }

    public function declaracaosem($id_declaracao)
    {
        $declaracao = Declaracao::find($id_declaracao);
        if (!$declaracao) {
            return back()->with(['error' => "Não encontrou declaração"]);
        }

        $historico = HistoricEstudante::where(['id_estudante' => $declaracao->id_estudante, 'ano_lectivo' => $declaracao->ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Não encontrou estudante"]);
        }

        $data  = [
            'getDeclaracao' => $declaracao,
            'getHistorico' => $historico,
        ];
        $pdf = PDF::loadView('relatorios.declaracaosem', $data)->setPaper('A4', 'normal');
        return $pdf->stream('DECLARAÇÃO SEM NOTAS ' . $declaracao->ano_lectivo . ' - [ ' . strtoupper($declaracao->estudante->pessoa->nome) . ' ].pdf');
    }

    public function declaracaocom($id_declaracao)
    {
        $declaracao = Declaracao::find($id_declaracao);
        if (!$declaracao) {
            return back()->with(['error' => "Não encontrou declaração"]);
        }
        $historico = HistoricEstudante::where(['id_estudante' => $declaracao->id_estudante, 'ano_lectivo' => $declaracao->ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Não encontrou estudante"]);
        }

        $turma = Turma::find($historico->id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        //verificar se selecionou a ordem das disciplinas
        $ordena_disciplina = null;
        if (!Session::has('disciplinas')) {
            $ordena_disciplina = OrdernaDisciplina::where(['id_curso' => $turma->id_curso, 'id_classe' => $turma->id_classe])->get();
        }


        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;

        $data['view'] = [
            'getHistorico' => $historico,
            'getDeclaracao' => $declaracao,
            'getTurma' => $turma,
            'getOrdenaDisciplinas' => $ordena_disciplina,
        ];

        if ($id_ensino == 1) { //iniciacao ate 6
            //se for classificacao quantitativa
            if (($classe == "2ª classe") || ($classe == "4ª classe") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe") || ($classe == "Módulo 2") || ($classe == "Módulo 1")) {
                $pdf = PDF::loadView('relatorios.ensinos.declaracao.ensino_primario_2_4_copy', $data['view'])->setPaper('A4', 'normal');
            } //se for classificacao quantitativa
            elseif (($classe == "Iniciação")) {
                $pdf = PDF::loadView('relatorios.ensinos.declaracao.ensino_primario_Ini_1_3_5_copy', $data['view'])->setPaper('A4', 'normal');
            } elseif (($classe == "6ª classe") || ($classe == "Módulo 3")) {
                $pdf = PDF::loadView('relatorios.ensinos.declaracao.ensino_primario_6_copy', $data['view'])->setPaper('A4', 'normal');
            }
        } elseif ($id_ensino == 2) { //7 classe ate 9 ensino geral
            if ($classe == "9ª classe") {
                $pdf = PDF::loadView('relatorios.ensinos.declaracao.ensino_1ciclo_9_copy', $data['view'])->setPaper('A4', 'normal');
            } else {
                $pdf = PDF::loadView('relatorios.ensinos.declaracao.ensino_1ciclo_7_8_copy', $data['view'])->setPaper('A4', 'normal');
            }
        }
        return $pdf->stream('DECLARAÇÃO COM NOTAS ' . $declaracao->ano_lectivo . ' - [ ' . strtoupper($declaracao->estudante->pessoa->nome) . ' ].pdf');
    }

    public function guiatransferencia($id_transferencia)
    {
        $transferencia = Transferencia::find($id_transferencia);
        if (!$transferencia) {
            return back()->with(['error' => "Não encontrou guia de transferencia"]);
        }

        $data  = [
            'getTransferencia' => $transferencia,
        ];
        $pdf = PDF::loadView('relatorios.ensinos.transferencias.geral', $data)->setPaper('A4', 'normal');
        return $pdf->stream('GUIA DE TRANSFERÊNCIA ' . $transferencia->ano_lectivo . ' - [ ' . strtoupper($transferencia->estudante->pessoa->nome) . ' ].pdf');
    }

    public function boletins(Request $request, $id_turma, $ano_lectivo)
    {
        $request->validate([
            'epoca' => ['required', 'integer', 'min:1',],
        ]);

        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }


        $id_pessoa = Auth::user()->pessoa->id;
        //se for administrador
        if ((Auth::user()->nivel_acesso == "admin") || (Auth::user()->nivel_acesso == "user")) {
            $directorTurma = DirectorTurma::where([
                'id_turma' => $id_turma,
                'ano_lectivo' => $ano_lectivo,
            ])->first();

            if (!$directorTurma) {
                return back()->with(['error' => "Não é Director desta turma"]);
            }
        } else {
            $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
            if (!$funcionario) {
                return back()->with(['error' => "Não encontrou funcionario"]);
            }

            if (Auth::user()->nivel_acesso == "professor") {
                $directorTurma = DirectorTurma::where([
                    'id_funcionario' => $funcionario->id,
                    'id_turma' => $id_turma,
                    'ano_lectivo' => $ano_lectivo,
                ])->first();

                if (!$directorTurma) {
                    return back()->with(['error' => "Não é Director desta turma"]);
                }
            }
        }

        if (!Session::has('disciplinas')) {
            return back()->with(['error' => "Deve selecionar as disciplinas"]);
        }

        $historico = HistoricEstudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])
            ->orderBy('numero', 'asc')->get();

        $data['view'] = [
            'getDirector' => $directorTurma,
            'getHistorico' => $historico,
            'getEpoca' => $request->epoca,
        ];

        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;


        if ($id_ensino == 1) { //iniciacao ate 6
            //se for classificacao quantitativa
            if (($classe == "2ª classe") || ($classe == "4ª classe") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe") || ($classe == "Módulo 2") || ($classe == "Módulo 1")) {

                $pdf = PDF::loadView('relatorios.ensinos.boletins.ensino_primario_2_4_copy', $data['view'])->setPaper('A4', 'normal');
            } //se for classificacao quantitativa
            elseif (($classe == "Iniciação")) {
                $pdf = PDF::loadView('relatorios.ensinos.boletins.ensino_primario_Ini_1_3_5_copy', $data['view'])->setPaper('A4', 'normal');
            } elseif (($classe == "6ª classe") || ($classe == "Módulo 3")) {
                $pdf = PDF::loadView('relatorios.ensinos.boletins.ensino_primario_6_copy', $data['view'])->setPaper('A4', 'normal');
            }
        } elseif ($id_ensino == 2) { //7 classe ate 9 ensino geral
            if ($classe == "9ª classe") {
                $pdf = PDF::loadView('relatorios.ensinos.boletins.ensino_1ciclo_9_copy', $data['view'])->setPaper('A4', 'normal');
            } else {
                $pdf = PDF::loadView('relatorios.ensinos.boletins.ensino_1ciclo_7_8_copy', $data['view'])->setPaper('A4', 'normal');
            }
        }
        return $pdf->stream('BOLETIM DE NOTAS ' . $request->epoca . 'º TRIMESTRE - ' . $ano_lectivo . '[ ' . strtoupper($turma->turma) . ' ' . strtoupper($turma->turno->turno) . '-' . strtoupper($turma->curso->curso) . ' ].pdf');
    }

    public function mapas_coordenadores($id_ensino, $ano_lectivo)
    {
        $ensino = Ensino::find($id_ensino);
        if (!$ensino) {
            return back()->with(['error' => "Não encontrou ensino"]);
        }

        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $cursos = Curso::where(['id_ensino' => $id_ensino,])->get();
        $classes = Classe::where(['id_ensino' => $id_ensino,])->get();
        $turnos = Turno::orderBy('id', 'asc')->get();
        $data['view'] = [
            'getEnsino' => $ensino,
            'getCursos' => $cursos,
            'getClasses' => $classes,
            'getAno' => $ano_lectivo,
            'getTurnos' => $turnos,
        ];
        $pdf = PDF::loadView('relatorios.coordenadores', $data['view'])->setPaper('A4', 'landscape');
        return $pdf->stream('MAPA DE COORDENADORES - ' . $ano_lectivo .  '[ ' . strtoupper($ensino->ensino) . ' ].pdf');
    }

    public function mapas_aproveitamentos(Request $request)
    {
        $request->validate([
            'epoca' => ['required', 'integer', 'min:1'],
            'ano_lectivo' => ['required', 'string',],
            'id_ensino' => ['required', 'integer', 'min:1'],
            'id_curso' => ['required', 'integer', 'min:1'],
        ]);

        $ensino = Ensino::find($request->id_ensino);
        if (!$ensino) {
            return back()->with(['error' => "Não encontrou ensino"]);
        }

        $ano_lectivos = AnoLectivo::where('ano_lectivo', $request->ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $curso = Curso::find($request->id_curso);
        if (!$curso) {
            return back()->with(['error' => "Não encontrou curso"]);
        }

        if (!Session::has('disciplinas')) {
            return back()->with(['error' => "Deve selecionar as disciplinas"]);
        }

        $classes = Classe::where(['id_ensino' => $request->id_ensino,])->orderBy('id', 'asc')->get();
        $turnos = Turno::orderBy('id', 'asc')->get();
        $data['view'] = [
            'getEnsino' => $ensino,
            'getClasses' => $classes,
            'getAno' => $request->ano_lectivo,
            'getTurnos' => $turnos,
            'getEpoca' => $request->epoca,
            'getCurso' => $curso,
        ];
        $pdf = PDF::loadView('relatorios.aproveitamento', $data['view'])->setPaper('A4', 'landscape');
        return $pdf->stream('MAPA DE APROVEITAMENTO - ' . $request->epoca . 'º TRIMESTRE - ' . $request->ano_lectivo .  '[ ' . strtoupper($ensino->ensino) . ' ].pdf');
    }

    public function mapas_estatistica(Request $request)
    {
        $request->validate([
            'epoca' => ['required', 'integer', 'min:1'],
            'ano_lectivo' => ['required', 'string',],
            'id_ensino' => ['required', 'integer', 'min:1'],
            'id_curso' => ['required', 'integer', 'min:1'],
        ]);

        $ensino = Ensino::find($request->id_ensino);
        if (!$ensino) {
            return back()->with(['error' => "Não encontrou ensino"]);
        }

        $ano_lectivos = AnoLectivo::where('ano_lectivo', $request->ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $curso = Curso::find($request->id_curso);
        if (!$curso) {
            return back()->with(['error' => "Não encontrou curso"]);
        }

        $classes = Classe::where(['id_ensino' => $request->id_ensino,])->orderBy('id', 'asc')->get();
        $turnos = Turno::orderBy('id', 'asc')->get();
        $data['view'] = [
            'getEnsino' => $ensino,
            'getClasses' => $classes,
            'getAno' => $request->ano_lectivo,
            'getTurnos' => $turnos,
            'getEpoca' => $request->epoca,
            'getCurso' => $curso,
        ];
        $pdf = PDF::loadView('relatorios.estatistica', $data['view'])->setPaper('A4', 'normal');
        return $pdf->stream('FICHA DE ESTATÍSTICA - ' . $request->epoca . 'º TRIMESTRE - ' . $request->ano_lectivo .  '[ ' . strtoupper($ensino->ensino) . ' ].pdf');
    }

    public function extrato_pagamentos($id_estudante, $ano_lectivo)
    {
        $estudante = Estudante::find($id_estudante);
        if (!$estudante) {
            return back()->with(['error' => "Não encontrou"]);
        }

        $historico = HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo])->first();
        if (!$historico) {
            return back()->with(['error' => "Estudante nao matriculado neste ano lectivo"]);
        }

        $pagamentos = Pagamento::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo])->get();
        $data = [
            'getHistorico' => $historico,
            'getPagamentos' => $pagamentos,
        ];

        $pdf = PDF::loadView('relatorios.extrato_pagamentos', $data)->setPaper('A4', 'normal');
        return $pdf->stream('EXTRATO PAGAMENTOS - [' . strtoupper($historico->estudante->pessoa->nome) . '-' . $historico->ano_lectivo .  ' ].pdf');
    }

    public function estatistica_geral(Request $request)
    {
        $request->validate([
            'ano_lectivo' => ['required', 'string',]
        ]);
        $ano_lectivo = AnoLectivo::find($request->ano_lectivo);
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $categorias = CategoriaEstudante::get();
        $turmas = Turma::where('turma', '!=', 'Nenhuma')->orderBy('id_classe', 'asc')->get();
        $data = [
            'getTurmas' => $turmas,
            'getCategorias' => $categorias,
            'getAno' => $ano_lectivo->ano_lectivo,
        ];
        $pdf = PDF::loadView('relatorios.estatistica_geral', $data)->setPaper('A4', 'landscape');
        return $pdf->stream('ESTATÍSTICA GERAL - [' . $ano_lectivo->ano_lectivo .  ' ].pdf');
    }

    public function printusers()
    {
        $users = User::all();
        $data = [
            'getUsuarios' => $users
        ];
        $pdf = PDF::loadView('relatorios.users', $data)->setPaper('A4', 'normal');
        return $pdf->stream('LISTA DE USUÁRIOS.pdf');
    }

    public function balancoDiario($data1, $data2)
    {
        $tipo_pagamentos = TipoPagamento::all();
        $data = [
            'data1' => $data1,
            'data2' => $data2,
            'getTiposPagamentos' => $tipo_pagamentos,
        ];
        $pdf = PDF::loadView('relatorios.balanco', $data)->setPaper('A4', 'normal');
        return $pdf->stream('BALANÇO - [' . date('d-m-Y', strtotime($data1)) . ' - ' . date('d-m-Y', strtotime($data2)) . ' ].pdf');
    }

    public function pautatrimestral(Request $request, $id_turma, $ano_lectivo)
    {
        $request->validate([
            'epoca' => ['required', 'integer', 'min:1',],
        ]);

        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        //verificar se selecionou a ordem das disciplinas
        $ordena_disciplina = null;
        if (!Session::has('disciplinas')) {
            $ordena_disciplina = OrdernaDisciplina::where(['id_curso' => $turma->id_curso, 'id_classe' => $turma->id_classe])->get();
        }

        $historico = HistoricEstudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])
            ->orderBy('numero', 'asc')->get();

        $data['view'] = [
            'getTurma' => $turma,
            'getHistorico' => $historico,
            'getEpoca' => $request->epoca,
            'getAno' => $ano_lectivo,
            'getOrdenaDisciplinas' => $ordena_disciplina,
        ];


        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;


        if ($id_ensino == 1) { //iniciacao ate 6
            //se for classificacao quantitativa
            if (($classe == "2ª classe") || ($classe == "4ª classe") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe") || ($classe == "Módulo 2") || ($classe == "Módulo 1")) {

                $pdf = PDF::loadView('minha_turma.ensinos.ensino_primario_2_4_copy', $data['view'])->setPaper('A4', 'landscape');
            } //se for classificacao quantitativa
            elseif (($classe == "Iniciação")) {
                $pdf = PDF::loadView('minha_turma.ensinos.ensino_primario_Ini_1_3_5_copy', $data['view'])->setPaper('A4', 'landscape');
            } elseif (($classe == "6ª classe") || ($classe == "Módulo 3")) {
                $pdf = PDF::loadView('minha_turma.ensinos.ensino_primario_6_copy', $data['view'])->setPaper('A4', 'landscape');
            }
        } elseif ($id_ensino == 2) { //7 classe ate 9 ensino geral
            if ($classe == "9ª classe") {
                $pdf = PDF::loadView('minha_turma.ensinos.ensino_1ciclo_9_copy', $data['view'])->setPaper('A4', 'landscape');
            } else {
                $pdf = PDF::loadView('minha_turma.ensinos.ensino_1ciclo_7_8_copy', $data['view'])->setPaper('A4', 'landscape');
            }
        }
        return $pdf->stream('PAUTA DO ' . $request->epoca . 'º TRIMESTRE - ' . $ano_lectivo . '[ ' . strtoupper($turma->turma) . ' ' . strtoupper($turma->turno->turno) . '-' . strtoupper($turma->curso->curso) . ' ].pdf');
    }

    public function saidas(Request $request)
    {
        $request->validate([
            'data_inicial' => ['required', 'date'],
            'data_final' => ['required', 'date'],
        ]);
        $saidas = Saida::whereBetween('data_saida', [$request->data_inicial, $request->data_final])->get();
        $data = [
            'getSaidas' => $saidas,
            'data_inicial' => $request->data_inicial,
            'data_final' => $request->data_final,
        ];

        $pdf = PDF::loadView('relatorios.saidas', $data)->setPaper('A4', 'normal');
        return $pdf->stream('SAÍDAS REFERENTES - [' . $request->data_inicial . ' / ' . $request->data_final . ' ].pdf');
    }
}

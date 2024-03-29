<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\BloqueioEpoca;
use App\CadeiraExame;
use App\CadeiraRecurso;
use App\ConfigBloqueio;
use App\Disciplina;
use App\EjaNotaFinal;
use App\EjaNotaMensal;
use App\EjaNotaTrimestral;
use App\Estudante;
use App\Finals;
use App\Funcionario;
use App\Horario;
use App\Trimestral;
use App\Turma;
use App\ModuloFinal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CadernetaController_copy extends Controller
{
    public function list($ano_lectivo)
    {
        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou"]);
        }
        $anos = AnoLectivo::orderBy('id', 'desc')->get();
        $id_pessoa = Auth::user()->pessoa->id;
        $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
        $data['where'] = [
            'id_funcionario' => $funcionario->id,
            'ano_lectivo' => $ano_lectivo,
            'estado' => "visivel",
        ];
        $horarios = Horario::where($data['where'])->paginate(10);
        Session::put('id_funcionario', $funcionario->id);

        //pegando todos os valores dos bloqueios dos trimestres
        $estado_epoca1 = BloqueioEpoca::where(['epoca' => 1])->first();
        $estado_epoca2 = BloqueioEpoca::where(['epoca' => 2])->first();
        $estado_epoca3 = BloqueioEpoca::where(['epoca' => 3])->first();
        $estado_epoca4 = BloqueioEpoca::where(['epoca' => 4])->first();
        $estado_epoca5 = BloqueioEpoca::where(['epoca' => 5])->first();

        $data = [
            'title' => "Caderneta",
            'type' => "caderneta",
            'menu' => "Caderneta",
            'submenu' => "Listar",
            'getHorario' => $horarios,
            'getAnos' => $anos,

            'getEpoca1' => $estado_epoca1,
            'getEpoca2' => $estado_epoca2,
            'getEpoca3' => $estado_epoca3,
            'getEpoca4' => $estado_epoca4,
            'getEpoca5' => $estado_epoca5,
        ];

        return view('caderneta.list', $data);
    }

    public function create($id_turma, $id_disciplina, $ano_lectivo, $epoca)
    {

        //verificar se a epoca existe
        if (($epoca != 1) && ($epoca != 2) && ($epoca != 3) && ($epoca != 4) && ($epoca != 5)) {
            return back()->with(['error' => "Não encontrou epoca"]);
        } else {
            Session::put('epoca', $epoca);
        }


        //veirficar turma se existe
        $id_ensino = null;
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }
        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;

        if ($classe != "Módulo 3") {
            //verificando se a epoca está bloqueada
            $bloqueios = BloqueioEpoca::where(['epoca' => $epoca])->first();
            if ($bloqueios->estado == "off") {
                return back()->with(['error' => "Epoca bloqueiada"]);
            }
        }


        //pegando ano lectivo e verificando
        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        //negar se o ano lectivo ja estiver bloqueado
        if ($ano_lectivos->estado == "off") {
            return back()->with(['error' => "Sem permissão de fazer lançamentos para esta turma"]);
        }

        //verificando disciplina
        $disciplina = Disciplina::find($id_disciplina);
        if (!$disciplina) {
            return back()->with(['error' => "Não encontrou disciplina"]);
        }

        //verificando se o professor e dono desta turma
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
        //data
        $data2 = [
            'id_disciplinaCAD' => $id_disciplina,
            'id_turmaCAD' => $id_turma,
            'ano_lectivoCAD' => $ano_lectivo,
            'epocaCAD' => $epoca,
            'id_ensinoCAD' => $id_ensino,
            'classeCAD' => $classe,
        ];
        //guardando valores na secao
        Session::put($data2);




        $trimestral = null;
        $global = null;

        //pegando dados trimestrais para exibir na view
        if (($epoca != 4) && ($epoca != 5)) {

            $trimestral = Trimestral::whereHas('estudante', function ($query) use ($data2) {
                $query->where('id_turma', $data2['id_turmaCAD']);
                $query->where('ano_lectivo', $data2['ano_lectivoCAD']);
            })->where(['epoca' => $data2['epocaCAD'], 'id_disciplina' => $data2['id_disciplinaCAD'], 'ano_lectivo' => $data2['ano_lectivoCAD']])
                ->get()->sortBy('estudante.numero');
        } else {
            //pegando dados finais para exibir na view
            $global = Finals::whereHas('estudante', function ($query) use ($data2) {
                $query->where('id_turma', $data2['id_turmaCAD']);
                $query->where('ano_lectivo', $data2['ano_lectivoCAD']);
            })->where(['id_disciplina' => $data2['id_disciplinaCAD'], 'ano_lectivo' => $data2['ano_lectivoCAD']])
                ->get()->sortBy('estudante.numero');
        }

        //pegando todos os valores dos bloqueios dos trimestres
        $estado_epoca1 = BloqueioEpoca::where(['epoca' => 1])->first();
        $estado_epoca2 = BloqueioEpoca::where(['epoca' => 2])->first();
        $estado_epoca3 = BloqueioEpoca::where(['epoca' => 3])->first();
        $estado_epoca4 = BloqueioEpoca::where(['epoca' => 4])->first();
        $estado_epoca5 = BloqueioEpoca::where(['epoca' => 5])->first();

        //verificar cadeiras que tem exame
        $cadeira_exame = false;
        $cadeira_exame = CadeiraExame::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
            'id_disciplina' => $id_disciplina,
            'estado' => "on",
        ])->first();

        //verificar cadeiras que tem exame
        $cadeira_recurso = false;
        $cadeira_recurso = CadeiraRecurso::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
            'id_disciplina' => $id_disciplina,
            'estado' => "on",
        ])->first();

        $config_bloqueios = ConfigBloqueio::where(['id_bloqueio' => $epoca])->get();

        $modulo_finals = null;
        if ($classe == "Módulo 3") {
            $modulo_finals = ModuloFinal::whereHas('estudante', function ($query) use ($data2) {
                $query->where('id_turma', $data2['id_turmaCAD']);
                $query->where('ano_lectivo', $data2['ano_lectivoCAD']);
            })->where(['id_disciplina' => $data2['id_disciplinaCAD'], 'ano_lectivo' => $data2['ano_lectivoCAD']])
                ->get()->sortBy('estudante.numero');
        }

        $data = [
            'title' => "Caderneta",
            'type' => "mobile",
            'menu' => "Caderneta",
            'submenu' => "Lançamento",
            'getHorario' => $horario,
            'getId_turma' => $id_turma,
            'getId_disciplina' => $id_disciplina,
            'getAno_lectivo' => $ano_lectivo,

            'getTrimestral' => $trimestral,
            'getGlobal' => $global,
            'getEpoca1' => $estado_epoca1,
            'getEpoca2' => $estado_epoca2,
            'getEpoca3' => $estado_epoca3,
            'getEpoca4' => $estado_epoca4,
            'getEpoca5' => $estado_epoca5,
            'getCadeiraRecurso' => $cadeira_recurso,
            'getCadeiraExame' => $cadeira_exame,
            'getConfigBloqueios' => $config_bloqueios,
            'getModuloFinals' => $modulo_finals,
        ];

        if ($id_ensino == 1) { //iniciacao ate 6
            //se for classificacao quantitativa
            if (($classe == "2ª classe") || ($classe == "4ª classe") || ($classe == "1ª classe") || ($classe == "3ª classe") || ($classe == "5ª classe") || ($classe == "Módulo 2") || ($classe == "Módulo 1")) {
                return view('caderneta.ensinos.ensino_primario_2_4_copy', $data);
            } //se for classificacao quantitativa
            elseif (($classe == "Iniciação")) {
                return view('caderneta.ensinos.ensino_primario_Ini_1_3_5_copy', $data);
            } elseif (($classe == "6ª classe")) {
                return view('caderneta.ensinos.ensino_primario_6_copy', $data);
            } elseif (($classe == "Módulo 3")) {
                return view('caderneta.ensinos.ensino_1ciclo_3_modulo_copy', $data);
            }
        } elseif ($id_ensino == 2) { //7 classe ate 9 ensino geral
            if ($classe == "9ª classe") {
                return view('caderneta.ensinos.ensino_1ciclo_9_copy', $data);
            } else {
                return view('caderneta.ensinos.ensino_1ciclo_7_8_copy', $data);
            }
        }
    }


    public function ejamensal($id_turma, $id_disciplina, $ano_lectivo, $epoca, $mes, $semana)
    {
        //verificar se a epoca existe
        if (($epoca != 1) && ($epoca != 2) && ($epoca != 3)) {
            return back()->with(['error' => "Não encontrou epoca"]);
        } else {
            Session::put('epoca', $epoca);
        }

        if (($semana != 1) && ($semana != 2) && ($semana != 3) && ($semana != 4)) {
            return back()->with(['error' => "Não encontrou semana"]);
        }

        if (($mes != 1) && ($mes != 2) && ($mes != 3) && ($mes != 4) && ($mes != 5) && ($mes != 6) && ($mes != 7) && ($mes != 8) && ($mes != 9)) {
            return back()->with(['error' => "Não encontrou mês"]);
        }

        //verificando se a epoca está bloqueada
        $bloqueios = BloqueioEpoca::where(['epoca' => $epoca])->first();
        if ($bloqueios->estado == "off") {
            return back()->with(['error' => "Epoca bloqueiada"]);
        }

        //veirficar turma se existe
        $id_ensino = null;
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }
        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;

        //pegando ano lectivo e verificando
        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        //negar se o ano lectivo ja estiver bloqueado
        if ($ano_lectivos->estado == "off") {
            return back()->with(['error' => "Sem permissão de fazer lançamentos para esta turma"]);
        }

        //verificando disciplina
        $disciplina = Disciplina::find($id_disciplina);
        if (!$disciplina) {
            return back()->with(['error' => "Não encontrou disciplina"]);
        }

        //verificando se o professor e dono desta turma
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
        //data
        $data2 = [
            'id_disciplinaCAD' => $id_disciplina,
            'id_turmaCAD' => $id_turma,
            'ano_lectivoCAD' => $ano_lectivo,
            'epocaCAD' => $epoca,
            'id_ensinoCAD' => $id_ensino,
            'classeCAD' => $classe,
            'semanaCAD' => $semana,
            'mesCAD' => $mes,
        ];
        //guardando valores na secao
        Session::put($data2);

        //pegando todos os valores dos bloqueios dos trimestres
        $estado_epoca1 = BloqueioEpoca::where(['epoca' => 1])->first();
        $estado_epoca2 = BloqueioEpoca::where(['epoca' => 2])->first();
        $estado_epoca3 = BloqueioEpoca::where(['epoca' => 3])->first();

        $mensal = EjaNotaMensal::whereHas('estudante', function ($query) use ($data2) {
            $query->where('id_turma', $data2['id_turmaCAD']);
            $query->where('ano_lectivo', $data2['ano_lectivoCAD']);
        })->where(['epoca' => $data2['epocaCAD'], 'id_disciplina' => $data2['id_disciplinaCAD'], 'mes' => $data2['mesCAD']])
            ->get()->sortBy('estudante.numero');

        $data = [
            'title' => "Caderneta",
            'type' => "mobile",
            'menu' => "Caderneta",
            'submenu' => "Lançamento",
            'getHorario' => $horario,
            'getId_turma' => $id_turma,
            'getId_disciplina' => $id_disciplina,
            'getAno_lectivo' => $ano_lectivo,

            'getMensal' => $mensal,
            'getEpoca1' => $estado_epoca1,
            'getEpoca2' => $estado_epoca2,
            'getEpoca3' => $estado_epoca3,
            'getSemana' => $semana,
            'getMes' => $mes,
        ];

        return view('caderneta.ensinos.ensino_ejamensal_7_9', $data);
    }

    public function ejatrimestral($id_turma, $id_disciplina, $ano_lectivo, $epoca)
    {
        //verificar se a epoca existe
        if (($epoca != 1) && ($epoca != 2) && ($epoca != 3) && ($epoca != 4) && ($epoca != 5)) {
            return back()->with(['error' => "Não encontrou epoca"]);
        } else {
            Session::put('epoca', $epoca);
        }

        //verificando se a epoca está bloqueada
        $bloqueios = BloqueioEpoca::where(['epoca' => $epoca])->first();
        if ($bloqueios->estado == "off") {
            return back()->with(['error' => "Epoca bloqueiada"]);
        }

        //veirficar turma se existe
        $id_ensino = null;
        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }
        //buscando ensino atraves de turma
        $id_ensino = $turma->classe->id_ensino;
        $classe = $turma->classe->classe;

        //pegando ano lectivo e verificando
        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        //negar se o ano lectivo ja estiver bloqueado
        if ($ano_lectivos->estado == "off") {
            return back()->with(['error' => "Sem permissão de fazer lançamentos para esta turma"]);
        }

        //verificando disciplina
        $disciplina = Disciplina::find($id_disciplina);
        if (!$disciplina) {
            return back()->with(['error' => "Não encontrou disciplina"]);
        }

        //verificando se o professor e dono desta turma
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
        //data
        $data2 = [
            'id_disciplinaCAD' => $id_disciplina,
            'id_turmaCAD' => $id_turma,
            'ano_lectivoCAD' => $ano_lectivo,
            'epocaCAD' => $epoca,
            'id_ensinoCAD' => $id_ensino,
            'classeCAD' => $classe,
        ];
        //guardando valores na secao
        Session::put($data2);


        $trimestral = null;
        $global = null;

        //pegando dados trimestrais para exibir na view
        if (($epoca != 4) && ($epoca != 5)) {

            $trimestral = EjaNotaTrimestral::whereHas('estudante', function ($query) use ($data2) {
                $query->where('id_turma', $data2['id_turmaCAD']);
                $query->where('ano_lectivo', $data2['ano_lectivoCAD']);
            })->where(['epoca' => $data2['epocaCAD'], 'id_disciplina' => $data2['id_disciplinaCAD']])
                ->get()->sortBy('estudante.numero');
        } else {
            //pegando dados finais para exibir na view
            $global = EjaNotaFinal::whereHas('estudante', function ($query) use ($data2) {
                $query->where('id_turma', $data2['id_turmaCAD']);
                $query->where('ano_lectivo', $data2['ano_lectivoCAD']);
            })->where(['id_disciplina' => $data2['id_disciplinaCAD']])
                ->get()->sortBy('estudante.numero');
        }

        //pegando todos os valores dos bloqueios dos trimestres
        $estado_epoca1 = BloqueioEpoca::where(['epoca' => 1])->first();
        $estado_epoca2 = BloqueioEpoca::where(['epoca' => 2])->first();
        $estado_epoca3 = BloqueioEpoca::where(['epoca' => 3])->first();
        $estado_epoca4 = BloqueioEpoca::where(['epoca' => 4])->first();
        $estado_epoca5 = BloqueioEpoca::where(['epoca' => 5])->first();

        //verificar cadeiras que tem exame
        $cadeira_exame = false;
        $cadeira_exame = CadeiraExame::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
            'id_disciplina' => $id_disciplina,
            'estado' => "on",
        ])->first();

        //verificar cadeiras que tem exame
        $cadeira_recurso = false;
        $cadeira_recurso = CadeiraRecurso::where([
            'id_curso' => $turma->id_curso,
            'id_classe' => $turma->id_classe,
            'id_disciplina' => $id_disciplina,
            'estado' => "on",
        ])->first();

        $data = [
            'title' => "Caderneta",
            'type' => "mobile",
            'menu' => "Caderneta",
            'submenu' => "Lançamento",
            'getHorario' => $horario,
            'getId_turma' => $id_turma,
            'getId_disciplina' => $id_disciplina,
            'getAno_lectivo' => $ano_lectivo,

            'getTrimestral' => $trimestral,
            'getGlobal' => $global,
            'getEpoca1' => $estado_epoca1,
            'getEpoca2' => $estado_epoca2,
            'getEpoca3' => $estado_epoca3,
            'getEpoca4' => $estado_epoca4,
            'getEpoca5' => $estado_epoca5,
            'getCadeiraRecurso' => $cadeira_recurso,
            'getCadeiraExame' => $cadeira_exame,
        ];

        return view('caderneta.ensinos.ensino_ejatrimestral_7_9', $data);
    }

    public function store_copy($id_turma, $id_disciplina, $epoca, $ano_lectivo)
    {
        if (($epoca == 1) || ($epoca == 2) || ($epoca == 3)) {

            $turma = Turma::find($id_turma);
            if (!$turma) {
                return back()->with(['error' => "Não encontrou turma"]);
            }

            $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
            if (!$ano_lectivos) {
                return back()->with(['error' => "Não encontrou ano lectivo"]);
            }

            //negar se o ano lectivo ja estiver bloqueado
            if ($ano_lectivos->estado == "off") {
                return back()->with(['error' => "Sem permissão de fazer lançamentos para esta turma"]);
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

            $data['trimestral'] = [
                'id_estudante' => null,
                'id_disciplina' => $id_disciplina,
                'epoca' => $epoca,
                'estado' => "on",
                'ano_lectivo' => $ano_lectivo,
            ];

            $data['final'] = [
                'id_estudante' => null,
                'id_disciplina' => $id_disciplina,
                'estado' => "on",
                'ano_lectivo' => $ano_lectivo,
            ];

            $estudantes = Estudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])->get();

            //cadastar trimestral
            foreach ($estudantes as $estudante) {
                $data['trimestral']['id_estudante'] = $estudante->id;
                if (!Trimestral::where($data['trimestral'])->first()) {
                    $nota_trimestral = Trimestral::create($data['trimestral']);
                }
            }

            //cadastrar finais
            foreach ($estudantes as $estudante) {
                $data['final']['id_estudante'] = $estudante->id;
                if (!Finals::where($data['final'])->first()) {
                    $nota_trimestral = Finals::create($data['final']);
                }
            }

            return back()->with(['success' => "Actualizou com sucesso"]);
        } else {
            return back(['success' => "Actualizado com sucesso"]);
        }
    }

    public function store_copy_ejatrimestral($id_turma, $id_disciplina, $epoca, $ano_lectivo)
    {
        if (($epoca == 1) || ($epoca == 2) || ($epoca == 3)) {

            $turma = Turma::find($id_turma);
            if (!$turma) {
                return back()->with(['error' => "Não encontrou turma"]);
            }

            $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
            if (!$ano_lectivos) {
                return back()->with(['error' => "Não encontrou ano lectivo"]);
            }

            //negar se o ano lectivo ja estiver bloqueado
            if ($ano_lectivos->estado == "off") {
                return back()->with(['error' => "Sem permissão de fazer lançamentos para esta turma"]);
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

            $data['trimestral'] = [
                'id_estudante' => null,
                'id_disciplina' => $id_disciplina,
                'epoca' => $epoca,
                'estado' => "on",
                'ano_lectivo' => $ano_lectivo,
            ];

            $data['final'] = [
                'id_estudante' => null,
                'id_disciplina' => $id_disciplina,
                'estado' => "on",
                'ano_lectivo' => $ano_lectivo,
            ];

            $estudantes = Estudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])->get();

            //cadastar trimestral
            foreach ($estudantes as $estudante) {
                $data['trimestral']['id_estudante'] = $estudante->id;
                if (!EjaNotaTrimestral::where($data['trimestral'])->first()) {
                    $nota_trimestral = EjaNotaTrimestral::create($data['trimestral']);
                }
            }

            //cadastrar finais
            foreach ($estudantes as $estudante) {
                $data['final']['id_estudante'] = $estudante->id;
                if (!EjaNotaFinal::where($data['final'])->first()) {
                    $nota_trimestral = EjaNotaFinal::create($data['final']);
                }
            }

            return back()->with(['success' => "Actualizou com sucesso"]);
        } else {
            return back(['success' => "Actualizado com sucesso"]);
        }
    }

    public function store_copy_ejamensal($id_turma, $id_disciplina, $epoca, $mes, $ano_lectivo)
    {
        if (($epoca == 1) || ($epoca == 2) || ($epoca == 3)) {
            if (($mes == 1) || ($mes == 2) || ($mes == 3) || ($mes == 4) || ($mes == 5) || ($mes == 6) || ($mes == 7) || ($mes == 8) || ($mes == 9)) {

                $turma = Turma::find($id_turma);
                if (!$turma) {
                    return back()->with(['error' => "Não encontrou turma"]);
                }

                $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
                if (!$ano_lectivos) {
                    return back()->with(['error' => "Não encontrou ano lectivo"]);
                }

                //negar se o ano lectivo ja estiver bloqueado
                if ($ano_lectivos->estado == "off") {
                    return back()->with(['error' => "Sem permissão de fazer lançamentos para esta turma"]);
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

                $data['mensal'] = [
                    'id_estudante' => null,
                    'id_disciplina' => $id_disciplina,
                    'mes' => $mes,
                    'epoca' => $epoca,
                    'estado' => "on",
                    'ano_lectivo' => $ano_lectivo,
                ];

                $estudantes = Estudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])->get();
                //cadastar mensal
                foreach ($estudantes as $estudante) {
                    $data['mensal']['id_estudante'] = $estudante->id;
                    if (!EjaNotaMensal::where($data['mensal'])->first()) {
                        $nota_mensal = EjaNotaMensal::create($data['mensal']);
                    }
                }

                return back()->with(['success' => "Actualizou com sucesso"]);
            }
        } else {
            return back(['success' => "Actualizado com sucesso"]);
        }
    }

    public function store_copy_modulo($id_turma, $id_disciplina, $ano_lectivo)
    {

        $turma = Turma::find($id_turma);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        $ano_lectivos = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if (!$ano_lectivos) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        //negar se o ano lectivo ja estiver bloqueado
        if ($ano_lectivos->estado == "off") {
            return back()->with(['error' => "Sem permissão de fazer lançamentos para esta turma"]);
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

        $data = [
            'id_estudante' => null,
            'id_disciplina' => $id_disciplina,
            'ano_lectivo' => $ano_lectivo,
        ];

        $estudantes = Estudante::where(['id_turma' => $id_turma, 'ano_lectivo' => $ano_lectivo])->get();

        //cadastar trimestral
        foreach ($estudantes as $estudante) {
            $data['id_estudante'] = $estudante->id;
            if (!ModuloFinal::where($data)->first()) {
                $modulo_final = ModuloFinal::create($data);
            }
        }
        return back()->with(['success' => "Actualizou com sucesso"]);
    }
}
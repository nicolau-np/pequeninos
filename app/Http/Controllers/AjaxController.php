<?php

namespace App\Http\Controllers;


use App\Classe;
use App\Curso;
use App\Disciplina;
use App\EjaNotaMensal;
use App\Encarregado;
use App\Estudante;
use App\Finals;
use App\Funcionario;
use App\Grade;
use App\HistoricEstudante;
use App\Hora;
use App\Horario;
use App\Municipio;
use App\NotaFinal;
use App\NotaTrimestral;
use App\ObservacaoGeral;
use App\Trimestral;
use App\Turma;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    public function getClasses(Request $request)
    {
        $request->validate([
            'id_curso' => ['required', 'Integer'],
        ]);
        $curso = Curso::find($request->id_curso);
        if (!$curso) {
            return response()->json(['error' => "Não encontrou curso"]);
        }
        $classes = Classe::where('id_ensino', $curso->id_ensino)->pluck('classe', 'id');
        $data = [
            'getClasses' => $classes,
        ];
        return view('ajax_loads.getClasses', $data);
    }

    public function getClasses3(Request $request)
    {
        $request->validate([
            'id_curso' => ['required', 'Integer'],
        ]);
        $curso = Curso::find($request->id_curso);
        if (!$curso) {
            return response()->json(['error' => "Não encontrou curso"]);
        }
        $classes = Classe::where('id_ensino', $curso->id_ensino)->pluck('classe', 'id');
        $data = [
            'getClasses' => $classes,
        ];
        return view('ajax_loads.getClasses3', $data);
    }

    public function getClasses4(Request $request)
    {
        $request->validate([
            'id_curso' => ['required', 'Integer'],
        ]);
        $curso = Curso::find($request->id_curso);
        if (!$curso) {
            return response()->json(['error' => "Não encontrou curso"]);
        }
        $classes = Classe::where('id_ensino', $curso->id_ensino)->pluck('classe', 'id');
        $data = [
            'getClasses' => $classes,
        ];
        return view('ajax_loads.getClasses4', $data);
    }

    public function getMunicipios(Request $request)
    {
        $request->validate([
            'id_provincia' => ['required', 'Integer'],
        ]);
        $municipio = Municipio::where('id_provincia', $request->id_provincia)->pluck('municipio', 'id');

        $data = [
            'getMunicipios' => $municipio,
        ];
        return view('ajax_loads.getMunicipios', $data);
    }

    public function getTurmas(Request $request)
    {
        $request->validate([
            'id_classe' => ['required', 'Integer'],
            'id_curso' => ['required', 'Integer']
        ]);
        $turmas = Turma::where(['id_curso' => $request->id_curso, 'id_classe' => $request->id_classe])->pluck('turma', 'id');

        $data = [
            'getTurmas' => $turmas,
        ];
        return view('ajax_loads.getTurmas', $data);
    }

    public function getEncarregados(Request $request)
    {

        $encarregados = Encarregado::whereHas('pessoa', function ($query) use ($request) {
            $query->where('nome', 'LIKE', "%{$request->search_text}%");
        })->get();
        $data = [
            'getEncarregados' => $encarregados,
        ];
        return view('ajax_loads.getEncarregados', $data);
    }

    public function getDisciplinas(Request $request)
    {
        $disciplinas = Disciplina::where('disciplina', 'LIKE', "%{$request->search_text}%")->get();
        $data = [
            'getDisciplinas' => $disciplinas,
        ];
        return view('ajax_loads.getDisciplinas', $data);
    }

    public function addDisciplinas(Request $request)
    {
        $data['disciplinas'] = [
            'id_disciplina' => $request->id_disciplina,
            'sigla' => $request->sigla,
        ];
        if (Session::has('disciplinas')) {
            foreach (Session::get('disciplinas') as $disciplinas) {
                if ($disciplinas['id_disciplina'] == $data['disciplinas']['id_disciplina']) {
                    return response()->json(['status' => "error", 'sms' => "Já adicionou esta disciplina"]);
                }
            }
        }
        Session::push('disciplinas', $data['disciplinas']);
        return response()->json(['status' => "ok", 'sms' => "Feito com sucesso"]);
    }

    public function getDisciplinasSelecionadas()
    {
        if (Session::has('disciplinas')) {
            return view('ajax_loads.getDisciplinasSelecionadas');
        } else {
            return "Não encontrou";
        }
    }

    public function removeDisciplinas()
    {
        if (Session::has('disciplinas')) {
            Session::forget('disciplinas');
            return response()->json(['status' => "ok", "sms" => "Removeu disciplinas"]);
        }
        return response()->json(['status' => "error", "sms" => "Já Removeu"]);
    }

    public function searchEstudantes(Request $request)
    {
        $estudantes  = Estudante::whereHas('pessoa', function ($query) use ($request) {
            $query->where('nome', 'LIKE', "%{$request->search_text}%");
        })->limit(5)->get();

        $data = [
            'getEstudantes' => $estudantes
        ];
        return view('ajax_loads.searchEstudantes', $data);
    }

    public function searchFuncionarios(Request $request)
    {
        $funcionarios  = Funcionario::whereHas('pessoa', function ($query) use ($request) {
            $query->where('nome', 'LIKE', "%{$request->search_text}%");
        })->limit(5)->get();

        $data = [
            'getFuncionarios' => $funcionarios
        ];
        return view('ajax_loads.searchFuncionarios', $data);
    }

    public function searchUsuarios(Request $request)
    {
        $usuarios  = User::whereHas('pessoa', function ($query) use ($request) {
            $query->where('nome', 'LIKE', "%{$request->search_text}%");
        })->limit(5)->get();

        $data = [
            'getUsuarios' => $usuarios
        ];
        return view('ajax_loads.searchUsuarios', $data);
    }

    public function searchEncarregados(Request $request)
    {
        $encarregados  = Encarregado::whereHas('pessoa', function ($query) use ($request) {
            $query->where('nome', 'LIKE', "%{$request->search_text}%");
        })->limit(5)->get();

        $data = [
            'getEncarregados' => $encarregados
        ];
        return view('ajax_loads.searchEncarregados', $data);
    }

    public function getDisciplinasCad(Request $request)
    {
        $disciplinas = Grade::where(['id_curso' => $request->id_curso, 'id_classe' => $request->id_classe])->get();
        $data = [
            'getGrade' => $disciplinas,
        ];
        return view('ajax_loads.getDisciplinasCad', $data);
    }

    public function getDisciplinasCad2(Request $request)
    {
        $disciplinas = Grade::where(['id_curso' => $request->id_curso, 'id_classe' => $request->id_classe])->get();
        $data = [
            'getGrade' => $disciplinas,
        ];
        return view('ajax_loads.getDisciplinasCad2', $data);
    }

    public function getDisciplinasCad3(Request $request)
    {
        $disciplinas = Disciplina::whereHas('grade', function ($query) use ($request) {
            $query->where(['id_curso' => $request->id_curso, 'id_classe' => $request->id_classe]);
        })->pluck('disciplina', 'id');
        $data = [
            'getGrade' => $disciplinas,
        ];
        return view('ajax_loads.getDisciplinasCad3', $data);
    }

    public function getHoras(Request $request)
    {
        $turma = Turma::find($request->id_turma);
        $horas = Hora::where('id_turno', $turma->id_turno)->get();

        $data = [
            'getHoras' => $horas
        ];

        return view('ajax_loads.getHoras', $data);
    }

    public function getFuncionarios(Request $request)
    {
        $funcionarios = Funcionario::whereHas('pessoa', function ($query) use ($request) {
            $query->where('nome', 'LIKE', "%{$request->search_text}%");
        })->limit(10)->get();
        $data = [
            'getFuncionarios' => $funcionarios,
        ];
        return view('ajax_loads.getFuncionarios', $data);
    }

    public function getClasses2(Request $request)
    {
        $request->validate([
            'id_curso' => ['required', 'Integer'],
        ]);
        $curso = Curso::find($request->id_curso);
        if (!$curso) {
            return response()->json(['error' => "Não encontrou curso"]);
        }
        $classes = Classe::where('id_ensino', $curso->id_ensino)->get();
        $data = [
            'getClasses' => $classes,
        ];
        return view('ajax_loads.getClasses2', $data);
    }

    public function updateAvaliacao(Request $request)
    {
        if (Session::get('id_ensinoCAD') == 1) {
            $request->validate([
                'valor' => ['required', 'numeric', 'min:0', 'max:10'],
                'campo' => ['required', 'string', 'min:3', 'max:3'],
                'id_trimestral' => ['required', 'integer', 'min:1'],
            ]);
        } else {
            $request->validate([
                'valor' => ['required', 'numeric', 'min:0', 'max:20'],
                'campo' => ['required', 'string', 'min:3', 'max:3'],
                'id_trimestral' => ['required', 'integer', 'min:1'],
            ]);
        }
        //verificar se mudou os campos
        if (($request->campo != "av1") && ($request->campo != "av2") && ($request->campo != "av3")) {
            echo " \\mudou campos\\ ";
        }
        //verificar se mudou o id do trimestre
        $trimestral = Trimestral::find($request->id_trimestral);
        if (!$trimestral) {
            return null;
        }

        //verificando se o professor e dono desta turma
        if (Session::has('id_funcionario')) {
            //verificando horario e funcionario
            $data['where_horario'] = [
                'id_funcionario' => Session::get('id_funcionario'),
                'id_turma' => $trimestral->estudante->id_turma,
                'id_disciplina' => $trimestral->id_disciplina,
                'ano_lectivo' => $trimestral->ano_lectivo,
                'estado' => "visivel"
            ];

            $horario = Horario::where($data['where_horario'])->first();
            if (!$horario) {
                return null;
            }
        } else {
            return null;
        }

        //criando campos
        $campo = "" . $request->campo; //campo de avaliacao
        $campo2 = $request->campo . "_data"; //campo de data
        $data['trimestral'] = [
            "$campo" => $request->valor,
            "$campo2" => date('Y-m-d'),
        ];

        //salvando a nota avaliacao
        $trimestral = Trimestral::find($request->id_trimestral)->update($data['trimestral']);
        if ($trimestral) {
            echo " \\lancou avaliacao\\ ";
        } else {
            return null;
        }

        //efectuar os calculos a alteracao de uma nota
        $trimestral = Trimestral::find($request->id_trimestral);
        if (!$trimestral) {
            return null;
        }

        //calculando mac
        $soma_avaliacoes = 0;
        $quant_avaliacoes = 0;

        //caso 1
        if ($trimestral->av1_data != null && $trimestral->av2_data == null && $trimestral->av3_data == null) {
            $quant_avaliacoes = 1;
            $soma_avaliacoes = $trimestral->av1;
        } elseif ($trimestral->av2_data != null && $trimestral->av1_data == null && $trimestral->av3_data == null) {
            $quant_avaliacoes = 1;
            $soma_avaliacoes = $trimestral->av2;
        } elseif ($trimestral->av3_data != null && $trimestral->av1_data == null && $trimestral->av2_data == null) {
            $quant_avaliacoes = 1;
            $soma_avaliacoes = $trimestral->av3;
        }

        //caso 2

        if ($trimestral->av1_data != null && $trimestral->av2_data != null && $trimestral->av3_data == null) {
            $quant_avaliacoes = 2;
            $soma_avaliacoes = ($trimestral->av1 + $trimestral->av2);
        } elseif ($trimestral->av2_data != null && $trimestral->av3_data != null && $trimestral->av1_data == null) {
            $quant_avaliacoes = 2;
            $soma_avaliacoes = ($trimestral->av2 + $trimestral->av3);
        } elseif ($trimestral->av1_data != null && $trimestral->av3_data != null && $trimestral->av2_data == null) {
            $quant_avaliacoes = 2;
            $soma_avaliacoes = ($trimestral->av1 + $trimestral->av3);
        }

        //caso 3
        if ($trimestral->av1_data != null && $trimestral->av2_data != null && $trimestral->av3_data != null) {
            $quant_avaliacoes = 3;
            $soma_avaliacoes = ($trimestral->av1 + $trimestral->av2 + $trimestral->av3);
        }


        $mac = Trimestral::mac($soma_avaliacoes, $quant_avaliacoes);
        $data['mac'] = [
            'mac' => $mac,
        ];

        if (Trimestral::find($request->id_trimestral)->update($data['mac'])) {
            echo " \\lancou o mac\\ ";
        }
        //fim mac

        $trimestral = Trimestral::find($request->id_trimestral);
        if (!$trimestral) {
            return null;
        }

        //calculando mt
        $somas = 0;
        $quant_notas = 0;

        $npp_data = $trimestral->npp_data;
        $pt_data = $trimestral->pt_data;

        if ($npp_data == null && $pt_data == null) {
            $somas = $mac;
            $quant_notas = 1;
        } elseif ($npp_data != null && $pt_data == null) {
            $somas = $mac + $trimestral->npp;
            $quant_notas = 2;
        } elseif ($npp_data != null && $pt_data != null) {
            $somas = $mac + $trimestral->npp + $trimestral->pt;
            $quant_notas = 3;
        } elseif ($npp_data == null && $pt_data != null) {
            $somas = $mac + $trimestral->pt;
            $quant_notas = 2;
        }

        $mt = Trimestral::mt($somas, $quant_notas);
        $data['mt'] = [
            'mt' => $mt
        ];
        if (Trimestral::find($request->id_trimestral)->update($data['mt'])) {
            echo " \\lancou o mt\\ ";
        }
        //fim mt

        $data['where_mts'] = [
            'id_estudante' => $trimestral->id_estudante,
            'id_disciplina' => $trimestral->id_disciplina,
            'ano_lectivo' => $trimestral->ano_lectivo,
        ];

        $trimestral_mts = Trimestral::where($data['where_mts'])->get();
        //calculando mfd e mf
        $soma_mts = 0;
        foreach ($trimestral_mts as $mts) {
            if ($mts->mt != null) {
                $soma_mts = $soma_mts + $mts->mt;
            }
        }

        $final = Finals::where($data['where_mts'])->first();
        $mf = 0;
        $mfd = Finals::mfd($soma_mts);
        if ($final->npe_data == null) {
            $mf = Finals::mf($soma_mts);
        } else {
            $mf = Finals::mf_exame($mfd, $final->npe);
        }

        $data['calculo_final'] = [
            'mf' => $mf,
            'mfd' => $mfd,
        ];
        if (Finals::where($data['where_mts'])->update($data['calculo_final'])) {
            echo " \\lancou o mfd e mf \\ ";
        }
        //fim mfd e mf


    }

    public function updateProva(Request $request)
    {
        if (Session::get('id_ensinoCAD') == 1) {
            $request->validate([
                'valor' => ['required', 'numeric', 'min:0', 'max:10'],
                'campo' => ['required', 'string', 'min:2', 'max:3'],
                'id_trimestral' => ['required', 'integer', 'min:1'],
            ]);
        } else {
            $request->validate([
                'valor' => ['required', 'numeric', 'min:0', 'max:20'],
                'campo' => ['required', 'string', 'min:2', 'max:3'],
                'id_trimestral' => ['required', 'integer', 'min:1'],
            ]);
        }


        //verificar se mudou os campos
        if (($request->campo != "npp") && ($request->campo != "pt")) {
            echo " \\mudou campos\\ ";
        }
        //verificar se mudou o id do trimestre
        $trimestral = Trimestral::find($request->id_trimestral);
        if (!$trimestral) {
            return null;
        }

        //verificando se o professor e dono desta turma
        if (Session::has('id_funcionario')) {
            //verificando horario e funcionario
            $data['where_horario'] = [
                'id_funcionario' => Session::get('id_funcionario'),
                'id_turma' => $trimestral->estudante->id_turma,
                'id_disciplina' => $trimestral->id_disciplina,
                'ano_lectivo' => $trimestral->ano_lectivo,
                'estado' => "visivel"
            ];

            $horario = Horario::where($data['where_horario'])->first();
            if (!$horario) {
                return null;
            }
        } else {
            return null;
        }

        //criando campos
        $campo = "" . $request->campo; //campo de provas
        $campo2 = $request->campo . "_data"; //campo de data
        $data['trimestral'] = [
            "$campo" => $request->valor,
            "$campo2" => date('Y-m-d'),
        ];

        $trimestral = Trimestral::find($request->id_trimestral)->update($data['trimestral']);
        if ($trimestral) {
            echo " \\lancou prova\\ ";
        } else {
            return null;
        }

        //efectuar os calculos a alteracao de uma nota
        $trimestral = Trimestral::find($request->id_trimestral);
        if (!$trimestral) {
            return null;
        }

        //caculando mt
        $somas = 0;
        $quant_notas = 0;

        $npp_data = $trimestral->npp_data;
        $pt_data = $trimestral->pt_data;

        if ($npp_data != null && $pt_data == null) {
            $somas = $trimestral->mac + $trimestral->npp;
            $quant_notas = 2;
        } elseif ($npp_data != null && $pt_data != null) {
            $somas = $trimestral->mac + $trimestral->npp + $trimestral->pt;
            $quant_notas = 3;
        } elseif ($npp_data == null && $pt_data != null) {
            $somas = $trimestral->mac + $trimestral->pt;
            $quant_notas = 2;
        }

        $mt = Trimestral::mt($somas, $quant_notas);
        $data['mt'] = [
            'mt' => $mt
        ];

        if (Trimestral::find($request->id_trimestral)->update($data['mt'])) {
            echo " \\lancou o mt\\ ";
        }
        //fim mt

        $data['where_mts'] = [
            'id_estudante' => $trimestral->id_estudante,
            'id_disciplina' => $trimestral->id_disciplina,
            'ano_lectivo' => $trimestral->ano_lectivo,
        ];

        $trimestral_mts = Trimestral::where($data['where_mts'])->get();

        //calculando mfd e mf
        $soma_mts = 0;
        foreach ($trimestral_mts as $mts) {
            if ($mts->mt != null) {
                $soma_mts = $soma_mts + $mts->mt;
            }
        }

        $final = Finals::where($data['where_mts'])->first();
        $mf = 0;
        $mfd = Finals::mfd($soma_mts);
        if ($final->npe_data == null) {
            $mf = Finals::mf($soma_mts);
        } else {
            $mf = Finals::mf_exame($mfd, $final->npe);
        }

        $data['calculo_final'] = [
            'mf' => $mf,
            'mfd' => $mfd,
        ];
        if (Finals::where($data['where_mts'])->update($data['calculo_final'])) {
            echo " \\lancou o mfd e mf \\ ";
        }
        //fim mfd e mf
    }

    public function updateGlobal(Request $request)
    {
        //verificar ensino devido a nota que nao pode ser maior que 20 ou 10
        if (Session::get('id_ensinoCAD') == 1) {
            $request->validate([
                'valor' => ['required', 'numeric', 'min:0', 'max:10'],
                'campo' => ['required', 'string', 'min:2', 'max:3'],
                'id_final' => ['required', 'integer', 'min:1'],
            ]);
        } else {
            $request->validate([
                'valor' => ['required', 'numeric', 'min:0', 'max:20'],
                'campo' => ['required', 'string', 'min:2', 'max:3'],
                'id_final' => ['required', 'integer', 'min:1'],
            ]);
        }


        //verificar se mudou os campos
        if (($request->campo != "npe")) {
            echo " \\mudou campos\\ ";
        }
        //verificar se mudou o id do trimestre
        $final = Finals::find($request->id_final);
        if (!$final) {
            return null;
        }

        //verificando se o professor e dono desta turma
        if (Session::has('id_funcionario')) {
            //verificando horario e funcionario
            $data['where_horario'] = [
                'id_funcionario' => Session::get('id_funcionario'),
                'id_turma' => $final->estudante->id_turma,
                'id_disciplina' => $final->id_disciplina,
                'ano_lectivo' => $final->ano_lectivo,
                'estado' => "visivel"
            ];

            $horario = Horario::where($data['where_horario'])->first();
            if (!$horario) {
                return null;
            }
        } else {
            return null;
        }

        //criando campos
        $campo = "" . $request->campo; //campo de provas
        $campo2 = $request->campo . "_data"; //campo de data
        $data['final'] = [
            "$campo" => $request->valor,
            "$campo2" => date('Y-m-d'),
        ];

        $final = Finals::find($request->id_final)->update($data['final']);
        if ($final) {
            echo " \\lancou npe\\ ";
        } else {
            return null;
        }

        $final = Finals::find($request->id_final);

        //calculando mf
        $mfd = 0;
        $npe = $final->npe;
        if ($final->mfd == null) {
            $mfd = 0;
        } else {
            $mfd = $final->mfd;
        }

        $mf = Finals::mf_exame($mfd, $npe);

        $data['calculo_final'] = [
            'mf' => $mf
        ];
        if (Finals::find($request->id_final)->update($data['calculo_final'])) {
            echo " \\lancou o mf\\ ";
        }
        //fim mfd e mf
    }

    public function updateRecurso(Request $request)
    {
        //verificar ensino devido a nota que nao pode ser maior que 20 ou 10
        if (Session::get('id_ensinoCAD') == 1) {
            $request->validate([
                'valor' => ['required', 'numeric', 'min:0', 'max:5'],
                'campo' => ['required', 'string', 'min:2', 'max:3'],
                'id_final' => ['required', 'integer', 'min:1'],
            ]);
        } else {
            $request->validate([
                'valor' => ['required', 'numeric', 'min:0', 'max:10'],
                'campo' => ['required', 'string', 'min:2', 'max:3'],
                'id_final' => ['required', 'integer', 'min:1'],
            ]);
        }

        //verificar se mudou os campos
        if (($request->campo != "rec")) {
            echo " \\mudou campos\\ ";
        }

        //verificar se mudou o id do trimestre
        $final = Finals::find($request->id_final);
        if (!$final) {
            return null;
        }

        //verificando se o professor e dono desta turma
        if (Session::has('id_funcionario')) {
            //verificando horario e funcionario
            $data['where_horario'] = [
                'id_funcionario' => Session::get('id_funcionario'),
                'id_turma' => $final->estudante->id_turma,
                'id_disciplina' => $final->id_disciplina,
                'ano_lectivo' => $final->ano_lectivo,
                'estado' => "visivel"
            ];

            $horario = Horario::where($data['where_horario'])->first();
            if (!$horario) {
                return null;
            }
        } else {
            return null;
        }

        //criando campos
        $campo = "" . $request->campo; //campo de provas
        $campo2 = $request->campo . "_data"; //campo de data
        $data['final'] = [
            "$campo" => $request->valor,
            "$campo2" => date('Y-m-d'),
        ];


        $final = Finals::find($request->id_final)->update($data['final']);
        if ($final) {
            echo " \\lancou npe\\ ";
        } else {
            return null;
        }
    }

    public function updateAV_mensal(Request $request)
    {
        $request->validate([
            'valor' => ['required', 'numeric', 'min:0', 'max:1'],
            'campo' => ['required', 'string', 'min:2', 'max:4'],
            'id_mensal' => ['required', 'integer', 'min:1'],
        ]);
        //verificar se mudou os campos

        //verifica se mudou o id do mes
        $mensal = EjaNotaMensal::find($request->id_mensal);
        if (!$mensal) {
            return null;
        }

        //verificando se o professor e dono desta turma
        if (Session::has('id_funcionario')) {
            //verificando horario e funcionario
            $data['where_horario'] = [
                'id_funcionario' => Session::get('id_funcionario'),
                'id_turma' => $mensal->estudante->id_turma,
                'id_disciplina' => $mensal->id_disciplina,
                'ano_lectivo' => $mensal->ano_lectivo,
                'estado' => "visivel"
            ];

            $horario = Horario::where($data['where_horario'])->first();
            if (!$horario) {
                return null;
            }
        } else {
            return null;
        }

        //criando campos
        $campo = "" . $request->campo; //campo de avaliacao
        $data['mensal'] = [
            "$campo" => $request->valor,
        ];

        //salvando a nota avaliacao
        $mensal = EjaNotaMensal::find($request->id_mensal)->update($data['mensal']);
        if ($mensal) {
            echo " \\lancou avaliacao\\ ";
        } else {
            return null;
        }

        //efectuar os calculos a alteracao de uma nota
        $mensal = EjaNotaMensal::find($request->id_mensal);
        if (!$mensal) {
            return null;
        }

        $somas = 0;
        $campo_media = null;
        //campos de tpc
        if (($campo == "tpc1") || ($campo == "tpc2") || ($campo == "tpc3") || ($campo == "tpc4")) {
            $somas = $mensal->tpc1 + $mensal->tpc2 + $mensal->tpc3 + $mensal->tpc4;
            $campo_media = "tpc_media";
        } elseif (($campo == "oc1") || ($campo == "oc2") || ($campo == "oc3") || ($campo == "oc4")) {
            $somas = $mensal->oc1 + $mensal->oc2 + $mensal->oc3 + $mensal->oc4;
            $campo_media = "oc_media";
        } elseif (($campo == "pg1") || ($campo == "pg2") || ($campo == "pg3") || ($campo == "pg4")) {
            $somas = $mensal->pg1 + $mensal->pg2 + $mensal->pg3 + $mensal->pg4;
            $campo_media = "pg_media";
        } elseif (($campo == "pa1") || ($campo == "pa2") || ($campo == "pa3") || ($campo == "pa4")) {
            $somas = $mensal->pa1 + $mensal->pa2 + $mensal->pa3 + $mensal->pa4;
            $campo_media = "pa_media";
        }

        $media_mensal = EjaNotaMensal::calc_medias_mensais($somas);
        $data['media_mensal'] = [
            "$campo_media" => $media_mensal,
        ];

        //salvando a nota media
        $mensal = EjaNotaMensal::find($request->id_mensal)->update($data['media_mensal']);
        if ($mensal) {
            echo " \\lancou media\\ ";
        } else {
            return null;
        }

        //calculanco total
        $mensal = EjaNotaMensal::find($request->id_mensal);
        if (!$mensal) {
            return null;
        }

        $total = EjaNotaMensal::calc_total_mensal($mensal->tpc_media, $mensal->oc_media, $mensal->pg_media, $mensal->pa_media, $mensal->tp_media);

        $data['total'] = [
            'total' => $total,
        ];

        //salvando a nota total
        $mensal = EjaNotaMensal::find($request->id_mensal)->update($data['total']);
        if ($mensal) {
            echo " \\lancou total\\ ";
        } else {
            return null;
        }

        /*colocar calculo do semestre sempre que fazer alteracao aqui */

        /**fim */

        /*colocar calculo do final sempre que fazer alteracao aqui */

        /**fim */
    }

    public function updateTP_mensal(Request $request)
    {
        $request->validate([
            'valor' => ['required', 'numeric', 'min:0', 'max:10'],
            'campo' => ['required', 'string', 'min:2', 'max:4'],
            'id_mensal' => ['required', 'integer', 'min:1'],
        ]);
        //verificar se mudou os campos

        //verifica se mudou o id do mes
        $mensal = EjaNotaMensal::find($request->id_mensal);
        if (!$mensal) {
            return null;
        }

        //verificando se o professor e dono desta turma
        if (Session::has('id_funcionario')) {
            //verificando horario e funcionario
            $data['where_horario'] = [
                'id_funcionario' => Session::get('id_funcionario'),
                'id_turma' => $mensal->estudante->id_turma,
                'id_disciplina' => $mensal->id_disciplina,
                'ano_lectivo' => $mensal->ano_lectivo,
                'estado' => "visivel"
            ];

            $horario = Horario::where($data['where_horario'])->first();
            if (!$horario) {
                return null;
            }
        } else {
            return null;
        }

        //criando campos
        $campo = "" . $request->campo; //campo de avaliacao
        $data['mensal'] = [
            "$campo" => $request->valor,
        ];

        //salvando a nota avaliacao
        $mensal = EjaNotaMensal::find($request->id_mensal)->update($data['mensal']);
        if ($mensal) {
            echo " \\lancou avaliacao\\ ";
        } else {
            return null;
        }

        //efectuar os calculos a alteracao de uma nota
        $mensal = EjaNotaMensal::find($request->id_mensal);
        if (!$mensal) {
            return null;
        }


        //campos de tpc
        $somas = $mensal->tp1 + $mensal->tp2 + $mensal->tp3 + $mensal->tp4;
        $campo_media = "tp_media";

        $media_mensal = EjaNotaMensal::calc_medias_mensais($somas);
        $data['media_mensal'] = [
            "$campo_media" => $media_mensal,
        ];

        //salvando a nota media
        $mensal = EjaNotaMensal::find($request->id_mensal)->update($data['media_mensal']);
        if ($mensal) {
            echo " \\lancou media\\ ";
        } else {
            return null;
        }

        //calculanco total
        $mensal = EjaNotaMensal::find($request->id_mensal);
        if (!$mensal) {
            return null;
        }

        $total = EjaNotaMensal::calc_total_mensal($mensal->tpc_media, $mensal->oc_media, $mensal->pg_media, $mensal->pa_media, $mensal->tp_media);

        $data['total'] = [
            'total' => $total,
        ];

        //salvando a nota total
        $mensal = EjaNotaMensal::find($request->id_mensal)->update($data['total']);
        if ($mensal) {
            echo " \\lancou total\\ ";
        } else {
            return null;
        }

        /*colocar calculo do semestre sempre que fazer alteracao aqui */

        /**fim */

        /*colocar calculo do final sempre que fazer alteracao aqui */

        /**fim */
    }

    public function updateProvaEJA(Request $request)
    {
        $request->validate([
            'valor' => ['required', 'numeric', 'min:0', 'max:14'],
            'campo' => ['required', 'string', 'min:2', 'max:6'],
            'id_trimestral' => ['required', 'integer', 'min:1'],
        ]);
    }

    public function acharObervacao($id_estudante, $ano_lectivo)
    {
        $obs_final = null;
        $count_negativas = 0;
        $observacao_geral = 22; //dando um valor qualquer para que nao deia erro se nao encontrar nenhuma obs geral

        $historico = HistoricEstudante::where(['id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo])->first();
        if ($historico) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }
        $turma = Turma::find($historico->id_turma);
        if ($turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }

        // pesquisar horario desta turma neste ano
        $horarios = Horario::where(['id_turma' => $turma->id, 'ano_lectivo' => $ano_lectivo, 'estado' => "visivel"])->get();
        //observacao geral
        $obs_geral = ObservacaoGeral::where(['id_curso' => $turma->id_curso, 'id_classe' => $turma->id_classe])->first();
        if ($obs_geral) {
            $observacao_geral = $obs_geral->quantidade_negativas;
        }

        foreach ($horarios as $horario) {
            //ciclo para listagem de todas as disciplinas que já tem professor nesta turma.
            $dados_finais = Finals::where(
                [
                    'id_estudante' => $historico->id_estudante,
                    'ano_lectivo' => $historico->ano_lectivo,
                    'id_disciplina' => $horario->id_disciplina
                ]
            )->first(); //pegar os dados finais de cada disciplina

            if ($dados_finais) {

                if ($turma->curso->id_ensino == 1) { //ensino primario nota <=4.99 && 2.99
                    if (($dados_finais->rec != null) && ($dados_finais->rec <= 2.99)) { //se fez recurso entao verifica com o valor do recurso
                        $count_negativas++;
                    } elseif (($dados_finais->rec == null) && ($dados_finais->mf != null) && ($dados_finais->mf <= 4.99)) {
                        $count_negativas++;
                    }
                } elseif ($turma->curso->id_ensino >= 2) { //1 ciclo e ensino secundario nota<=9.99 && 4.99
                    if (($dados_finais->rec != null) && ($dados_finais->rec <= 4.99)) { //se fez recurso entao verifica com o valor do recurso
                        $count_negativas++;
                    } elseif (($dados_finais->rec == null) && ($dados_finais->mf != null) && ($dados_finais->mf <= 9.99)) {
                        $count_negativas++;
                    }
                }
            }
        }
    }

    public function getCursoEnsino(Request $request)
    {
        Session::forget('disciplinas');
        $request->validate([
            'id_ensino' => ['required', 'integer', 'min:1'],
        ]);
        $cursos = Curso::where(['id_ensino' => $request->id_ensino,])->pluck('curso', 'id');
        $data = [
            'getCursos' => $cursos,
        ];
        return view('ajax_loads.getCursosEnsino', $data);
    }

    public function getDisciplinasCurso(Request $request)
    {
        $request->validate([
            'id_curso' => ['required', 'integer', 'min:1'],
        ]);

        $grade_curricular = Grade::where(['id_curso' => $request->id_curso,])->distinct()->get(['id_disciplina']);
        $data = [
            'getGrades' => $grade_curricular,
        ];

        return view('ajax_loads.getGrades', $data);
    }
}
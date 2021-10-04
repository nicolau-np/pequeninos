<?php

namespace App\Http\Controllers;


use App\Classe;
use App\Curso;
use App\Disciplina;
use App\Encarregado;
use App\Estudante;
use App\Finals;
use App\Funcionario;
use App\Grade;
use App\Hora;
use App\Horario;
use App\Municipio;
use App\NotaFinal;
use App\NotaTrimestral;
use App\Trimestral;
use App\Turma;
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
        })->get();

        $data = [
            'getEstudantes' => $estudantes
        ];
        return view('ajax_loads.searchEstudantes', $data);
    }

    public function searchFuncionarios(Request $request)
    {
        $funcionarios  = Funcionario::whereHas('pessoa', function ($query) use ($request) {
            $query->where('nome', 'LIKE', "%{$request->search_text}%");
        })->get();

        $data = [
            'getFuncionarios' => $funcionarios
        ];
        return view('ajax_loads.searchFuncionarios', $data);
    }

    public function searchEncarregados(Request $request)
    {
        $encarregados  = Encarregado::whereHas('pessoa', function ($query) use ($request) {
            $query->where('nome', 'LIKE', "%{$request->search_text}%");
        })->get();

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
        })->get();
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
        }else{
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
        }else{
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

    public function updateRecurso(Request $request){
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

    public function getDisciplinasEnsino($id_curso){
        $grade_curricular = Grade::where(['id_curso'=> $id_curso])->get();
        return $grade_curricular;
    }
}

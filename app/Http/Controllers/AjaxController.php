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

    /*public function updateAvaliacao(Request $request)
    {
        $request->validate([
            'valor' => ['required', 'numeric'],
            'campo' => ['required', 'Integer'],
            'id_avaliacao' => ['required', 'Integer'],
        ]);

        $avaliacao = Avaliacao::find($request->id_avaliacao);
        if (!$avaliacao) {
            return response()->json(['status' => "error", 'sms' => "Nao encontrou avaliacao"]);
        }

        $trimestral = NotaTrimestral::where([
            'id_estudante' => $avaliacao->id_estudante,
            'id_disciplina' => $avaliacao->id_disciplina,
            'epoca' => $avaliacao->epoca,
            'ano_lectivo' => $avaliacao->ano_lectivo,
        ])->first();

        $final = NotaFinal::where([
            'id_estudante' => $avaliacao->id_estudante,
            'id_disciplina' => $avaliacao->id_disciplina,
            'ano_lectivo' => $avaliacao->ano_lectivo,
        ])->first();

        $coluna1 = "valo" . $request->campo;
        $coluna2 = "data" . $request->campo;
        $data['avaliacao'] = [
            "$coluna1" => $request->valor,
            "$coluna2" => date('Y-m-d'),
        ];

        $avalia = Avaliacao::find($request->id_avaliacao)->update($data['avaliacao']);
        if ($avalia) {
            $verifica_avaliacao = Avaliacao::find($request->id_avaliacao);
            $mac = 0;
            $soma = 0;
            $quant_avaliacao = 0;

            //caso 1
            if ($verifica_avaliacao->valo1 != "" && $verifica_avaliacao->valo2 != "" && $verifica_avaliacao->valo3 != "") {
                $quant_avaliacao = 3;
                $soma = ($verifica_avaliacao->valo1 + $verifica_avaliacao->valo2 + $verifica_avaliacao->valo3);
            }
            //caso 2
            elseif ($verifica_avaliacao->valo1 != "" && $verifica_avaliacao->valo2 != "" && $verifica_avaliacao->valo3 == "") {
                $quant_avaliacao = 2;
                $soma = ($verifica_avaliacao->valo1 + $verifica_avaliacao->valo2);
            }
            //caso 3
            elseif ($verifica_avaliacao->valo1 != "" && $verifica_avaliacao->valo2 == "" && $verifica_avaliacao->valo3 == "") {
                $quant_avaliacao = 1;
                $soma = ($verifica_avaliacao->valo1);
            }
            //caso 4
            elseif ($verifica_avaliacao->valo1 == "" && $verifica_avaliacao->valo2 == "" && $verifica_avaliacao->valo3 != "") {
                $quant_avaliacao = 1;
                $soma = ($verifica_avaliacao->valo3);
            }
            //caso 5
            elseif ($verifica_avaliacao->valo1 == "" && $verifica_avaliacao->valo2 != "" && $verifica_avaliacao->valo3 != "") {
                $quant_avaliacao = 2;
                $soma = ($verifica_avaliacao->valo2 + $verifica_avaliacao->valo3);
            }
            //caso 6
            elseif ($verifica_avaliacao->valo1 == "" && $verifica_avaliacao->valo2 != "" && $verifica_avaliacao->valo3 == "") {
                $quant_avaliacao = 1;
                $soma = ($verifica_avaliacao->valo2);
            }

            $mac = NotaTrimestral::mac($soma, $quant_avaliacao);
            $ct = NotaTrimestral::ct($mac, $trimestral->cpp);
            $trimest = NotaTrimestral::find($trimestral->id)->update(['mac' => $mac, 'ct' => $ct]);
            if ($trimest) {
                $soma_ct = NotaTrimestral::soma_ct($avaliacao->id_estudante, $avaliacao->id_disciplina, $avaliacao->ano_lectivo);
                $cap = NotaFinal::cap($soma_ct);
                $cf = NotaFinal::cf($cap, $final->cpe);

                $fin = NotaFinal::find($final->id)->update([
                    'cap' => $cap,
                    'cf' => $cf,
                ]);
                if ($fin) {
                    return response()->json(['status' => "ok", 'sms' => "Feito com sucesso"]);
                }
            }
        } else {
            return response()->json(['status' => "error", 'sms' => "Erro temporário no servidor"]);
        }
    }*/

    /*public function updateProva(Request $request)
    {
        $request->validate([
            'valor' => ['required', 'numeric'],
            'campo' => ['required', 'Integer'],
            'id_prova' => ['required', 'Integer'],
        ]);

        $prova = Prova::find($request->id_prova);
        if (!$prova) {
            return response()->json(['status' => "error", 'sms' => "Nao encontrou avaliacao"]);
        }

        $trimestral = NotaTrimestral::where([
            'id_estudante' => $prova->id_estudante,
            'id_disciplina' => $prova->id_disciplina,
            'epoca' => $prova->epoca,
            'ano_lectivo' => $prova->ano_lectivo,
        ])->first();

        $final = NotaFinal::where([
            'id_estudante' => $prova->id_estudante,
            'id_disciplina' => $prova->id_disciplina,
            'ano_lectivo' => $prova->ano_lectivo,
        ])->first();

        $coluna1 = "valor" . $request->campo;
        $coluna2 = "data" . $request->campo;
        $data['prova'] = [
            "$coluna1" => $request->valor,
            "$coluna2" => date('Y-m-d'),
        ];

        $prov = Prova::find($request->id_prova)->update($data['prova']);
        if ($prov) {
            $verifica_prova = Prova::find($request->id_prova);
            $cpp = 0;
            $soma = 0;
            $quant_prova = 0;

            //caso 1
            if ($verifica_prova->valor1 != "" && $verifica_prova->valor2 != "") {
                $soma = ($verifica_prova->valor1 + $verifica_prova->valor2);
                $quant_prova = 2;
            }
            //caso 2
            elseif ($verifica_prova->valor1 != "" && $verifica_prova->valor2 == "") {
                $soma = ($verifica_prova->valor1);
                $quant_prova = 1;
            }
            //caso 3
            elseif ($verifica_prova->valor1 == "" && $verifica_prova->valor2 != "") {
                $soma = ($verifica_prova->valor2);
                $quant_prova = 1;
            }
            //fim

            $cpp = NotaTrimestral::cpp($soma, $quant_prova);
            $ct = NotaTrimestral::ct($trimestral->mac, $cpp);
            $trimest = NotaTrimestral::find($trimestral->id)->update(['cpp' => $cpp, 'ct' => $ct]);
            if ($trimest) {
                $soma_ct = NotaTrimestral::soma_ct($prova->id_estudante, $prova->id_disciplina, $prova->ano_lectivo);
                $cap = NotaFinal::cap($soma_ct);
                $cf = NotaFinal::cf($cap, $final->cpe);

                $fin = NotaFinal::find($final->id)->update([
                    'cap' => $cap,
                    'cf' => $cf,
                ]);
                if ($fin) {
                    return response()->json(['status' => "ok", 'sms' => "Feito com sucesso"]);
                }
            }
        } else {
            return response()->json(['status' => "error", 'sms' => "Erro temporário no servidor"]);
        }
    }*/

    /*public function updateTrimestral(Request $request){
        $request->validate([
            'valor' => ['required', 'numeric', 'min:0'],
            'campo' => ['required', 'string'],
            'id_trimestral' => ['required', 'Integer'],
        ]);

        $campo = "" . $request->campo;
        $data['trimestral'] = [
            "$campo" => $request->valor,
        ];

        $trimestral = NotaTrimestral::find($request->id_trimestral);
        if (!$trimestral) {
            return response()->json(['status' => "error", 'sms' => "Nao encontrou Nota"]);
        }

        $final = NotaFinal::where([
            'id_estudante' => $trimestral->id_estudante,
            'id_disciplina' => $trimestral->id_disciplina,
            'ano_lectivo' => $trimestral->ano_lectivo,
        ])->first();

        NotaTrimestral::find($request->id_trimestral)->update($data['trimestral']);
        $trimestral = NotaTrimestral::find($request->id_trimestral);
        if($trimestral){
            $ct = NotaTrimestral::ct($trimestral->mac, $trimestral->cpp);
            $update_trimestralCT = NotaTrimestral::find($request->id_trimestral)->update(['ct'=>$ct]);
            if($update_trimestralCT){
                $soma_ct = NotaTrimestral::soma_ct($trimestral->id_estudante, $trimestral->id_disciplina, $trimestral->ano_lectivo);
                $cap = NotaFinal::cap($soma_ct);
                $cf = NotaFinal::cf($cap, $final->cpe);


                if (NotaFinal::find($final->id)->update(['cap' => $cap, 'cf' => $cf])) {
                    return response()->json(['status' => "ok", 'sms' => "Feito com sucesso"]);
                }
            }
        }

    }*/

    public function updateGlobal(Request $request)
    {
        $request->validate([
            'valor' => ['required', 'numeric', 'min:0'],
            'id_global' => ['required', 'Integer'],
        ]);

        $final = NotaFinal::find($request->id_global);
        if (!$final) {
            return response()->json(['status' => "error", 'sms' => "Nao encontrou avaliacao"]);
        }

        $data['global'] = [
            "cpe" => $request->valor,
            "data_lancamento" => date('Y-m-d'),
        ];

        $fin = NotaFinal::find($request->id_global)->update($data['global']);
        if ($fin) {
            $verifica_final = NotaFinal::find($request->id_global);
            $cf = 0;
            $cf = NotaFinal::cf($verifica_final->cap, $verifica_final->cpe);

            $fini = NotaFinal::find($final->id)->update(['cf' => $cf,]);
            if ($fini) {
                return response()->json(['status' => "ok", 'sms' => "Feito com sucesso"]);
            }
        } else {
            return response()->json(['status' => "error", 'sms' => "Erro temporário no servidor"]);
        }
    }

    public function updateTrimestral_copy(Request $request)
    {
        $request->validate([
            'valor' => ['required', 'numeric', 'min:0'],
            'campo' => ['required', 'string'],
            'id_trimestral' => ['required', 'integer', 'min:1'],
        ]);

        //verificar se mudou os campos
        if (($request->campo != "av1") || ($request->campo != "av2") || ($request->campo != "av3")) {
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
            echo " \\cadastrou as notas trimestrais\\ ";
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
        //calculando mfd
        $soma_mts = 0;
        foreach ($trimestral_mts as $mts) {
            if ($mts->mt != null) {
                $soma_mts = $soma_mts + $mts->mt;
            }
        }

        $mfd = Finals::mfd($soma_mts);
        $data['mfd'] = [
            'mfd' => $mfd,
        ];
        if (Finals::where($data['where_mts'])->update($data['mfd'])) {
            echo " \\lancou o mfd\\ ";
        }
        //fim mfd

    }
}
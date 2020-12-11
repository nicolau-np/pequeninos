<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Curso;
use App\Disciplina;
use App\Encarregado;
use App\Estudante;
use App\Funcionario;
use App\Grade;
use App\Hora;
use App\Municipio;
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
            'id_disciplina'=>$request->id_disciplina,
            'sigla'=>$request->sigla,
        ];
        if (Session::has('disciplinas')) {
            foreach(Session::get('disciplinas') as $disciplinas){
                if($disciplinas['id_disciplina'] == $data['disciplinas']['id_disciplina']){
                  return response()->json(['status'=>"error", 'sms'=>"Já adicionou esta disciplina"]);
                }
            }
        }
        Session::push('disciplinas', $data['disciplinas']);
        return response()->json(['status' => "ok", 'sms' => "Feito com sucesso"]);
        
    }

    public function getDisciplinasSelecionadas()
    {
        if(Session::has('disciplinas')){
           return view('ajax_loads.getDisciplinasSelecionadas'); 
        }else{
            return "Não encontrou";
        }  
    }

    public function removeDisciplinas()
    {
        if (Session::has('disciplinas')) {
            Session::forget('disciplinas');
            return response()->json(['status' => "ok", "sms" => "Removeu disciplinas"]);
        }
        return response()->json(['status'=>"error", "sms"=>"Já Removeu"]);
    }

    public function searchEstudantes(Request $request){
        $estudantes  = Estudante::whereHas('pessoa', function($query) use ($request){
            $query->where('nome', 'LIKE', "%{$request->search_text}%");
        })->get();

        $data = [
            'getEstudantes'=>$estudantes
        ];
        return view('ajax_loads.searchEstudantes', $data);
    }

    public function searchFuncionarios(Request $request){
        $funcionarios  = Funcionario::whereHas('pessoa', function($query) use ($request){
            $query->where('nome', 'LIKE', "%{$request->search_text}%");
        })->get();

        $data = [
            'getFuncionarios'=>$funcionarios
        ];
        return view('ajax_loads.searchFuncionarios', $data);
    }

    public function searchEncarregados(Request $request){
        $encarregados  = Encarregado::whereHas('pessoa', function($query) use ($request){
            $query->where('nome', 'LIKE', "%{$request->search_text}%");
        })->get();

        $data = [
            'getEncarregados'=>$encarregados
        ];
        return view('ajax_loads.searchEncarregados', $data);
    }

    public function getDisciplinasCad(Request $request){
        $disciplinas = Grade::where(['id_curso'=>$request->id_curso, 'id_classe'=>$request->id_classe])->get();
        $data = [
            'getGrade'=>$disciplinas,
        ];
        return view('ajax_loads.getDisciplinasCad', $data);
    }

    public function getHoras(Request $request){
        $turma = Turma::find($request->id_turma);
        $horas = Hora::where('id_turno', $turma->id_turno)->get();

        $data = [
            'getHoras'=>$horas
        ];

        return view('ajax_loads.getHoras', $data);
    }

    public function getFuncionarios(Request $request){
        $funcionarios = Funcionario::whereHas('pessoa', function ($query) use ($request) {
            $query->where('nome', 'LIKE', "%{$request->search_text}%");
        })->get();
        $data = [
            'getFuncionarios' => $funcionarios,
        ];
        return view('ajax_loads.getFuncionarios', $data);
    }
}
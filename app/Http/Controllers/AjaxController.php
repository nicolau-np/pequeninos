<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Curso;
use App\Disciplina;
use App\Encarregado;
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
        session()->push('disciplinas', $data['disciplinas']);
        return response()->json(['status' => "ok", 'sms' => "Feito com suceso"]);
    }

    public function getDisciplinasSelecionadas()
    {
      
        if (session()->has('disciplinas')) {
         return view('ajax_loads.getDisciplinasSelecionadas');
        }
        return "Nenhuma Selecionada";
    }

    public function removeDisciplinas()
    {
        if (session()->has('disciplinas')) {
            if (session()->forget('disciplinas')) {
                return response()->json(['status' => "ok", "sms" => "Removeu disciplinas"]);
            }
        }
        return response()->json(['status'=>"error", "sms"=>"Já Removeu"]);
    }
}
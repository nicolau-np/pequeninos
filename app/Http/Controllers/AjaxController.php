<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Curso;
use App\Municipio;
use App\Turma;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getClasses(Request $request){
        $request->validate([
            'id_curso'=>['required', 'Integer'],
        ]);
        $curso = Curso::find($request->id_curso);
        if(!$curso){
            return response()->json(['error'=>"Não encontrou curso"]);
        }
        $classes = Classe::where('id_ensino', $curso->id_ensino)->pluck('classe', 'id');
        $data = [
            'getClasses'=>$classes,
        ];
        return view('ajax_loads.getClasses', $data);
    }

    public function getMunicipios(Request $request){
        $request->validate([
            'id_provincia'=>['required', 'Integer'],
        ]);
        $municipio = Municipio::where('id_provincia', $request->id_provincia)->pluck('municipio','id');
    
        $data = [
            'getMunicipios'=>$municipio,
        ];
        return view('ajax_loads.getMunicipios', $data);
    }

    public function getTurmas(Request $request){
        $request->validate([
            'id_classe'=>['required', 'Integer'],
            'id_curso'=>['required', 'Integer']
        ]);
       $turmas = Turma::where(['id_curso'=>$request->id_curso, 'id_classe'=>$request->id_classe])->pluck('turma','id');
    
        $data = [
            'getTurmas'=>$turmas,
        ];
        return view('ajax_loads.getTurmas', $data);
    }
}
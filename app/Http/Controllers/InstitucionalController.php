<?php

namespace App\Http\Controllers;

use App\CompoDisciplina;
use App\Curso;
use App\Disciplina;
use App\Ensino;
use App\Grade;
use App\Turma;
use App\Turno;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class InstitucionalController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');   
    }
    
    public function curso_list(){
        $cursos = Curso::paginate(5);
        $data = [
            'title'=>"Cursos",
            'type'=>"institucional",
            'menu'=>"Cursos",
            'submenu'=>"Listar",
            'getCursos'=>$cursos,
        ];
        return view('institucional.cursos.list', $data);
    }
    public function curso_create(){
        $ensinos = Ensino::pluck('ensino', 'id');
        $data = [
            'title'=>"Cursos",
            'type'=>"institucional",
            'menu'=>"Cursos",
            'submenu'=>"Novo",
            'getEnsinos'=>$ensinos,
        ];
        return view('institucional.cursos.new', $data);
    }
    public function curso_store(Request $request){
        $request->validate([
            'ensino'=>['required', 'Integer'],
            'curso'=>['required', 'string', 'min:4', 'max:255']
        ]);

        $data=[
            'id_ensino'=>$request->ensino,
            'curso'=>$request->curso
        ];

        if(Curso::where($data)->first()){
            return back()->with(['error'=>"Já cadastrou este curso"]);
        }
        if(Curso::create($data)){
            return back()->with(['success'=>"Feito com sucesso"]);
        }
    }
    public function curso_edit($id){
        $curso = Curso::find($id);
        if(!$curso){
            return back()->with(['error'=>"Não encontrou o curso"]);
        }
        $ensinos = Ensino::pluck('ensino', 'id');
        $data = [
            'title'=>"Cursos",
            'type'=>"institucional",
            'menu'=>"Cursos",
            'submenu'=>"Editar",
            'getCurso'=>$curso,
            'getEnsinos'=>$ensinos,
        ];
        return view('institucional.cursos.edit', $data);
    }
    public function curso_update(Request $request, $id){
        $curso = Curso::find($id);
        if(!$curso){
            return back()->with(['error'=>"Não encontrou o curso"]);
        }
        $request->validate([
            'ensino'=>['required', 'Integer'],
            'curso'=>['required', 'string', 'min:4', 'max:255']
        ]);

        $data=[
            'id_ensino'=>$request->ensino,
            'curso'=>$request->curso
        ];
        if($request->ensino!=$curso->id_ensino || $request->curso!=$curso->curso){
            if(Curso::where($data)->first()){
                return back()->with(['error'=>"Já cadastrou este curso"]);
            }
        }
        
        if(Curso::find($id)->update($data)){
            return back()->with(['success'=>"Feito com sucesso"]);
        }
    }

    
    public function turma_list(){
        $turmas = Turma::paginate(5);
        $data = [
            'title'=>"Turmas",
            'type'=>"institucional",
            'menu'=>"Turmas",
            'submenu'=>"Listar",
            'getTurmas'=>$turmas,
        ];
        return view('institucional.turmas.list', $data);
    }

    public function turma_create(){
        $cursos = Curso::pluck('curso', 'id');
        $turnos = Turno::pluck('turno', 'id');
        $data = [
            'title'=>"Turmas",
            'type'=>"institucional",
            'menu'=>"Turmas",
            'submenu'=>"Novo",
            'getCursos'=>$cursos,
            'getTurnos'=>$turnos
        ];
        return view('institucional.turmas.new', $data);  
    }

    public function turma_store(Request $request){
        $request->validate([
            'curso'=>['required', 'Integer'],
            'classe'=>['required', 'Integer'],
            'turno'=>['required', 'Integer'],
            'turma'=>['required', 'string', 'min:1', 'max:255']
        ]);

        $data = [
            'id_curso'=>$request->curso,
            'id_classe'=>$request->classe,
            'id_turno'=>$request->turno,
            'turma'=>$request->turma,
        ];
        if(Turma::where($data)->first()){
            return back()->with(['error'=>"Já cadastrou esta turma"]);
        }

        if(Turma::create($data)){
            return back()->with(['success'=>"Feito com sucesso"]);
        }
    }

    public function turma_edit($id){
        $turma = Turma::find($id);
        if(!$turma){
           return back()->with(['error'=>"Não encontrou turma"]);
        }
        $cursos = Curso::pluck('curso', 'id');
        $turnos = Turno::pluck('turno', 'id');
        $data = [
            'title'=>"Turmas",
            'type'=>"institucional",
            'menu'=>"Turmas",
            'submenu'=>"Editar",
            'getCursos'=>$cursos,
            'getTurnos'=>$turnos,
            'getTurma'=>$turma
        ];
        return view('institucional.turmas.edit', $data); 
    }

    public function turma_update(Request $request, $id){
        $turma = Turma::find($id);
        if(!$turma){
           return back()->with(['error'=>"Não encontrou turma"]);
        }
        $request->validate([
            'curso'=>['required', 'Integer'],
            'classe'=>['required', 'Integer'],
            'turno'=>['required', 'Integer'],
            'turma'=>['required', 'string', 'min:1', 'max:255']
        ]);

        $data = [
            'id_curso'=>$request->curso,
            'id_classe'=>$request->classe,
            'id_turno'=>$request->turno,
            'turma'=>$request->turma,
        ];
        
        if($request->curso!=$turma->id_curso || $request->classe!=$turma->id_classe ||
         $request->turno!=$turma->id_turno || $request->turma!=$turma->turma){
           if(Turma::where($data)->first()){
            return back()->with(['error'=>"Já cadastrou esta turma"]);
            } 
        }
        
        if(Turma::find($id)->update($data)){
            return back()->with(['success'=>"Feito com sucesso"]);
        }
    }

    
    public function disciplina_list(){
        $disciplinas = Disciplina::paginate(5);
        $data = [
            'title'=>"Disciplinas",
            'type'=>"institucional",
            'menu'=>"Disciplinas",
            'submenu'=>"Listar",
            'getDisciplinas'=>$disciplinas,
        ];
        return view('institucional.disciplinas.list', $data);
    }

    public function disciplina_create(){
        $componentes = CompoDisciplina::pluck('componente', 'id');
        $data = [
            'title'=>"Disciplinas",
            'type'=>"institucional",
            'menu'=>"Disciplinas",
            'submenu'=>"Novo",
            'getComponentes'=>$componentes
        ];
        return view('institucional.disciplinas.new', $data);
    }

    public function disciplina_store(Request $request){
        $request->validate([
            'componente'=>['required', 'Integer'],
            'disciplina'=>['required', 'string', 'min:3', 'max:255', 'unique:disciplinas,disciplina'],
            'sigla'=>['required', 'string', 'min:1', 'max:255'],
        ]);

        $data = [
            'id_componente'=>$request->componente,
            'disciplina'=>$request->disciplina,
            'sigla'=>$request->sigla,
        ];

        if(Disciplina::where($data)->first()){
           return back()->with(['error'=>"Já cadastrou esta disciplina"]); 
        }

        if(Disciplina::create($data)){
            return back()->with(['success'=>"Feito com sucesso"]); 
        }
    }

    public function disciplina_edit($id){
        $disciplina = Disciplina::find($id);
        if(!$disciplina){
            return back()->with(['error'=>"Não encontrou disciplina"]);
        }
        
        $componentes = CompoDisciplina::pluck('componente', 'id');
        $data = [
            'title'=>"Disciplinas",
            'type'=>"institucional",
            'menu'=>"Disciplinas",
            'submenu'=>"Editar",
            'getComponentes'=>$componentes,
            'getDisciplina'=>$disciplina
        ];
        return view('institucional.disciplinas.edit', $data); 
    }

    public function disciplina_update(Request $request, $id){
        $disciplina = Disciplina::find($id);
        if(!$disciplina){
            return back()->with(['error'=>"Não encontrou disciplina"]);
        }

        $request->validate([
            'componente'=>['required', 'Integer'],
            'disciplina'=>['required', 'string', 'min:3', 'max:255'],
            'sigla'=>['required', 'string', 'min:1', 'max:255'],
        ]);

        $data = [
            'id_componente'=>$request->componente,
            'disciplina'=>$request->disciplina,
            'sigla'=>$request->sigla,
        ];

        if($request->componente!=$disciplina->id_componente || $request->disciplina!=$disciplina->disciplina_create 
         ||$request->sigla!=$disciplina->sigla){
             if(Disciplina::where($data)->first()){
                return back()->with(['error'=>"Já cadastrou esta disciplina"]); 
            }
        }
       

        if(Disciplina::find($id)->update($data)){
            return back()->with(['success'=>"Feito com sucesso"]); 
        }
    }

    public function grade_list(){
        $grade = Grade::paginate(5);
        $data = [
            'title'=>"Grades Curricular",
            'type'=>"institucional",
            'menu'=>"Grades Curricular",
            'submenu'=>"Listar",
            'getGrades'=>$grade,
        ];
        return view('institucional.grades.list', $data);
    }

    public function grade_create(){
        $data = [
            'title'=>"Grades Curricular",
            'type'=>"institucional",
            'menu'=>"Grades Curricular",
            'submenu'=>"Novo",
        ];
        return view('institucional.grades.new', $data);
    }

    public function grade_store(Request $request){
        
    }

    public function grade_edit($id){
        
    }

    public function grade_update(Request $request, $id){
        
    }
}
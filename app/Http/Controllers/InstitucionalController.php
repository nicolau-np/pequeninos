<?php

namespace App\Http\Controllers;

use App\Ensino;
use Illuminate\Http\Request;

class InstitucionalController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');   
    }
    
    public function curso_list(){
        $data = [
            'title'=>"Cursos",
            'type'=>"institucional",
            'menu'=>"Cursos",
            'submenu'=>"Listar"
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
            'getCursos'=>$ensinos,
        ];
        return view('institucional.cursos.new', $data);
    }
    public function curso_store(Request $request){
        $request->validate([
            'ensino'=>['required', 'Integer'],
            'curso'=>['required', 'string', 'min:6', 'max:255']
        ]);
    }
    public function curso_edit($id){
        $data = [
            'title'=>"Cursos",
            'type'=>"institucional",
            'menu'=>"Cursos",
            'submenu'=>"Editar"
        ];
        return view('institucional.cursos.edit', $data);
    }
    public function curso_update(Request $request, $id){
        
    }
}
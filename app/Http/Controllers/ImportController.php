<?php

namespace App\Http\Controllers;

use App\Imports\EstudanteImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index(){
        $data = [
            'title'=>"Okussoleka - Sistema de Gestão Escolar",
            'type'=>"home",
            'menu'=>"Home",
            'submenu'=>"",
        ];

        return view('import.new', $data);
    }

   
    public function store(Request $request){
        $file = $request->file('arquivo');
        
        Excel::import(new EstudanteImport, $file);
        return back()->with(['success'=>"Feito com sucesso"]);
    }
}
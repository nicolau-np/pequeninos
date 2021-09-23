<?php

namespace App\Http\Controllers;

use App\Imports\PessoaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index(){
        $data = [
            'title'=>"Importar EXCEL(.xls)",
            'type'=>"home",
            'menu'=>"Home",
            'submenu'=>"",
        ];

        return view('import.new', $data);
    }


    public function store(Request $request){
        $request->validate([
            'arquivo' => ['required', 'mimes:xlsx,xls'],
        ]);
        $file = $request->file('arquivo');

        $import = new PessoaImport;
        $import->import($file);

        return back()->with(['success'=>"Feito com sucesso"]);
    }


}
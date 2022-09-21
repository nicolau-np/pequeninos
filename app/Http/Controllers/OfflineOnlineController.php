<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Turma;
use Illuminate\Http\Request;
use App\Exports\EstudanteOfflineExport;
use App\Imports\EstudanteOnlineImport;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class OfflineOnlineController extends Controller
{
    public function list()
    {

        $data = [
            'title' => "Offline/Online",
            'type' => "offline_online",
            'menu' => "Offline/Online",
            'submenu' => "Listar",
        ];
        return view('offline_online.list', $data);
    }

    public function estudantes()
    {
        $anos = AnoLectivo::orderBy('id', 'desc')->pluck('ano_lectivo', 'id');
        $ano = AnoLectivo::orderBy('id', 'desc')->limit(1)->first();
        $turmas = Turma::where('turma', '!=', "Nenhuma")->orderBy('id', 'asc')->pluck('turma', 'id');
        $data = [
            'title' => "Offline/Online",
            'type' => "offline_online",
            'menu' => "Offline/Online",
            'submenu' => "Criar",
            'getTurmas' => $turmas,
            'getAnos' => $anos,
            'getAno' => $ano,
        ];
        return view('offline_online.estudantes', $data);
    }

    public function export_estudante(Request $request)
    {
        $turma = Turma::find($request->turma);
        $ano_lectivo = AnoLectivo::find($request->ano_lectivo);

        Session::put([
            'ano_lectivoEx' => $ano_lectivo->ano_lectivo,
            'turmaEx' => $turma->id,
        ]);

        $fileName = $turma->curso->curso . " " . $turma->classe->classe . " " . $turma->turma . " " . $turma->turno->turno . ".xlsx";
        return Excel::download(new EstudanteOfflineExport(), $fileName);
    }

    public function import_estudante(Request $request)
    {
        $request->validate([
            'ficheiro' => ['required', 'mimes:xlsx,xls'],
        ]);
        $file = $request->file('arquivo');

        $import = new EstudanteOnlineImport;

        if($import->import($file)){
            return back()->with(['success'=>"Feito com sucesso"]);
        }
    }
}

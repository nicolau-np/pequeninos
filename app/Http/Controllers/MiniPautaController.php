<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Disciplina;
use App\Turma;
use Illuminate\Http\Request;

class MiniPautaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_turma, $id_disciplina, $ano_lectivo)
    {
        $ano_lectivo = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if(!$ano_lectivo){
            return back()->with(['error'=>"Ano Lectivo não encontrado"]);
        }
        $turma = Turma::find($id_turma)->first();
        if(!$turma){
            return back()->with(['error'=>"Turma não encontrada"]);
        }

        $disciplina = Disciplina::find($id_disciplina);
        if(!$disciplina){
            return back()->with(['error'=>"Não encontrou disciplina"]);
        }
        $data = [
            'title' => "Mini Pauta",
            'type' => "minipauta",
            'menu' => "Mini Pauta",
            'submenu' => "Listar",
            'getTurma' => $turma,
            'getDisciplina' => $disciplina,
            'getAno_lectivo' => $ano_lectivo,  
        ];
        $id_ensino = $turma->classe->id_ensino;

        if ($id_ensino == 1) {
            return "ensino primario iniciacao ate 6 classe";
        } elseif ($id_ensino == 2) {
            return view('minipauta.ensino_1ciclo_7_9', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
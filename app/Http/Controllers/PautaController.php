<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\DirectorTurma;
use App\Funcionario;
use App\Grade;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PautaController extends Controller
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
    public function create($id_turma, $ano_lectivo)
    {
        $id_pessoa = Auth::user()->pessoa->id;
        $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
        if(!$funcionario){
            return back()->with(['error'=>"Não encontrou"]);
        }
        
        $turma = Turma::find($id_turma);
        if(!$turma){
            return back()->with(['error'=>"Não encontrou"]);
        }
        
        $ano_lecti = AnoLectivo::where('ano_lectivo', $ano_lectivo)->first();
        if(!$ano_lecti){
            return back()->with(['error'=>"Não encontrou"]);
        }

        $directorTurma = DirectorTurma::where([
            'id_funcionario'=>$funcionario->id,
            'id_turma'=>$id_turma,
            'ano_lectivo'=>$ano_lectivo,
        ])->first();

        if(!$directorTurma){
            return back()->with(['error'=>"Não é Director desta turma"]);
        }
        
        $grade_disciplinas = Grade::where([
            'id_curso'=>$turma->id_curso,
            'id_classe'=>$turma->id_classe,
        ])->get();
        
        $data = [
            'title' => "Pauta",
            'type' => "pauta",
            'menu' => "pauta",
            'submenu' => "Novo",
            'getDirector'=>$directorTurma,
            'getGrade'=>$grade_disciplinas,
        ];

        return view('minha_turma.new', $data);
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
    public function show($id)
    {
        //
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
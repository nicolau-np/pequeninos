<?php

namespace App\Http\Controllers;

use App\DirectorTurma;
use App\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MinhaTurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function __construct()
   {
        $this->middleware('prof');   
   }
     
    public function index()
    {
        $id_pessoa = Auth::user()->pessoa->id;
        $funcionario = Funcionario::where('id_pessoa', $id_pessoa)->first();
        if(!$funcionario){
            return back()->with(['error'=>"Não encontrou"]);
        }
        $minha_turmas = DirectorTurma::orderBy('id', 'desc')->where('id_funcionario', $funcionario->id)->paginate('8');
        $data = [
            'title' => "Minha Turma",
            'type' => "minha turma",
            'menu' => "Minha Turma",
            'submenu' => "Listar",
            'getTurmas'=>$minha_turmas,
        ];
        return view('minha_turma.list', $data);
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
<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Curso;
use App\DirectorTurma;
use Illuminate\Http\Request;

class DirectorTurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directores = DirectorTurma::paginate(5);
        $data = [
            'title' => "Directores de Turma",
            'type' => "directores",
            'menu' => "Directores de Turma",
            'submenu' => "Listar",
            'getDirectores'=>$directores,
        ];
        return view('directores.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = Curso::pluck('curso', 'id');
        $ano_lectivos = AnoLectivo::pluck('ano_lectivo', 'id');
        $data = [
            'title' => "Directores de Turma",
            'type' => "directores",
            'menu' => "Directores de Turma",
            'submenu' => "Novo",
            'getCursos'=>$cursos,
            'getAnoLectivo'=>$ano_lectivos,
        ];
        return view('directores.new', $data);
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
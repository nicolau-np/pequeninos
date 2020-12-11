<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Curso;
use App\Funcionario;
use App\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
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
    public function create($id_funcionario)
    {
        $funcionario = Funcionario::find($id_funcionario);
        if (!$funcionario) {
            return back()->with(['error' => "Não encontrou funcionário"]);
        }
        $cursos = Curso::pluck('curso', 'id');
        $ano_lectivos = AnoLectivo::pluck('ano_lectivo', 'id');
        $horarios = Horario::orderBy('id', 'desc')->where('id_funcionario', $id_funcionario)->paginate('8');
        $data = [
            'title' => "Horários",
            'type' => "funcionarios",
            'menu' => "Funcionários",
            'submenu' => $funcionario->pessoa->nome,
            'getCursos' => $cursos,
            'getAnoLectivo' => $ano_lectivos,
            'getFuncionario' => $funcionario,
            'getHorarios'=>$horarios,
        ];
        return view('horarios.new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_funcionario)
    {
        $funcionario = Funcionario::find($id_funcionario);
        if (!$funcionario) {
            return back()->with(['error' => "Não encontrou funcionário"]);
        }

        echo "save";
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
<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Curso;
use App\Funcionario;
use App\Horario;
use App\Sala;
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

        $ano_lectivo = AnoLectivo::find($request->ano_lectivo);
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }

        $request->validate([
            'curso'=>['required', 'integer'],
            'classe'=>['required', 'integer'],
            'disciplina'=>['required', 'integer'],
            'turma'=>['required', 'integer'],
            'ano_lectivo'=>['required', 'integer'],
        ]);

        $data ['store'] = [
        'id_funcionario'=>$id_funcionario,
        'id_turma'=>$request->turma,
        'id_disciplina'=>$request->disciplina,
        'estado'=>"visivel",
        'ano_lectivo'=>$ano_lectivo->ano_lectivo,

        ];

        $data['where4']=[
            'id_disciplina'=>$request->disciplina,
            'id_turma'=>$request->turma,
            'ano_lectivo'=>$ano_lectivo->ano_lectivo,
        ];

        //existencia de horario
        if(Horario::where($data['where4'])->first()){
            return back()->with(['error'=>"Já cadastrou este horário"]);
        }

        if(Horario::create($data['store'])){
            return back()->with(['success'=>"Feito com sucesso"]);
        }
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
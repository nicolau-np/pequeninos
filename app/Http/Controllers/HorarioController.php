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
        $salas = Sala::pluck('sala', 'id');
        $data = [
            'title' => "Horários",
            'type' => "funcionarios",
            'menu' => "Funcionários",
            'submenu' => $funcionario->pessoa->nome,
            'getCursos' => $cursos,
            'getAnoLectivo' => $ano_lectivos,
            'getFuncionario' => $funcionario,
            'getHorarios'=>$horarios,
            'getSalas'=>$salas,
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
        
        $request->validate([
            'curso'=>['required', 'Integer'],
            'classe'=>['required', 'Integer'],
            'disciplina'=>['required', 'Integer'],
            'sala'=>['required', 'Integer'],
            'hora'=>['required', 'Integer'],
            'turma'=>['required', 'Integer'],
            'semana'=>['required', 'string'],
            'ano_lectivo'=>['required', 'Integer'], 
        ]);
        
        $data ['store'] = [
        'id_funcionario'=>$id_funcionario,
        'id_turma'=>$request->turma,
        'id_disciplina'=>$request->disciplina,
        'id_sala'=>$request->sala,
        'id_hora'=>$request->hora,
        'semana'=>$request->semana,
        'estado'=>null,
        'ano_lectivo'=>$request->ano_lectivo,
       
        ];
        $data['where1']=[
            'id_funcionario'=>$id_funcionario,
            'id_turma'=>$request->turma,
            'id_disciplina'=>$request->disciplina,
            'id_sala'=>$request->sala,
            'id_hora'=>$request->hora,
            'semana'=>$request->semana,
            'ano_lectivo'=>$request->ano_lectivo,  
        ];

        $data['where2']=[
            'id_turma'=>$request->turma,
            'semana'=>$request->semana,
            'id_hora'=>$request->hora,
            'ano_lectivo'=>$request->ano_lectivo,  
        ];

        $data['where3']=[
            'id_funcionario'=>$id_funcionario,
            'semana'=>$request->semana,
            'id_hora'=>$request->hora,
            'ano_lectivo'=>$request->ano_lectivo,  
        ];

        $data['where4']=[
            'id_disciplina'=>$request->disciplina,
            'id_turma'=>$request->turma,
            'ano_lectivo'=>$request->ano_lectivo,  
        ];

        //existencia de horario
        if(Horario::where($data['where1'])->first()){
            return back()->with(['error'=>"Já cadastrou este horário"]);
        }

        //disponibilidade da turma
        if(Horario::where($data['where2'])->first()){
            return back()->with(['error'=>"Turma indisponível nesta hora"]); 
        }

        //disponibilidade do prof
        if(Horario::where($data['where3'])->first()){
            return back()->with(['error'=>"Professor indisponível nesta hora"]); 
        }

        $horario = Horario::where($data['where4'])->first();
        if(!$horario){
            $data['store']['estado'] = "visivel";
        }else{
            if($horario->id_funcionario!=$id_funcionario){
                return back()->with(['error'=>"Para esta turma e nesta disciplina já exite professor"]);
            }else{
                $data['store']['estado'] = "nao"; 
            }
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
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

    public function __construct()
    {
        $this->middleware('AdminUser');
    }
    public function index()
    {
        $directores = DirectorTurma::paginate(5);
        $data = [
            'title' => "Directores de Turma",
            'type' => "directores",
            'menu' => "Directores de Turma",
            'submenu' => "Listar",
            'getDirectores' => $directores,
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
            'getCursos' => $cursos,
            'getAnoLectivo' => $ano_lectivos,
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
        $request->validate([
            'funcionario' => ['required', 'Integer'],
            'curso' => ['required', 'Integer'],
            'classe' => ['required', 'Integer'],
            'turma' => ['required', 'Integer'],
            'ano_lectivo' => ['required', 'Integer'],
        ]);

        $ano_lectivo = AnoLectivo::find($request->ano_lectivo);
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou este ano"]);
        }

        $data['store'] = [
            'id_funcionario' => $request->funcionario,
            'id_turma' => $request->turma,
            'ano_lectivo' => $ano_lectivo->ano_lectivo,
        ];

        $data['where'] = [
            'id_turma' => $request->turma,
            'ano_lectivo' => $ano_lectivo->ano_lectivo,
        ];

        if (DirectorTurma::where($data['store'])->first()) {
            return back()->with(['error' => "Já cadastrou como Director"]);
        }

        if (DirectorTurma::where($data['where'])->first()) {
            return back()->with(['error' => "Esta turma já tem Director"]);
        }

        if (DirectorTurma::create($data['store'])) {
            return back()->with(['success' => "Feito com sucesso"]);
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
        $director = DirectorTurma::find($id);
        if (!$director) {
            return back()->with(['error' => "Não encontrou director"]);
        }

        $cursos = Curso::pluck('curso', 'id');
        $ano_lectivos = AnoLectivo::pluck('ano_lectivo', 'id');
        $ano_lectivo = AnoLectivo::where('ano_lectivo', $director->ano_lectivo)->first();
        $data = [
            'title' => "Directores de Turma",
            'type' => "directores",
            'menu' => "Directores de Turma",
            'submenu' => "Editar",
            'getCursos' => $cursos,
            'getAnoLectivo' => $ano_lectivos,
            'getDirector' => $director,
            'getAno' => $ano_lectivo,
        ];
        return view('directores.edit', $data);
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
        $director = DirectorTurma::find($id);
        if (!$director) {
            return back()->with(['error' => "Não encontrou director"]);
        }

        $request->validate([
            'funcionario' => ['required', 'Integer'],
            'curso' => ['required', 'Integer'],
            'classe' => ['required', 'Integer'],
            'turma' => ['required', 'Integer'],
            'ano_lectivo' => ['required', 'Integer'],
        ]);

        $ano_lectivo = AnoLectivo::find($request->ano_lectivo);
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou este ano"]);
        }

        $data['store'] = [
            'id_funcionario' => $request->funcionario,
            'id_turma' => $request->turma,
            'ano_lectivo' => $ano_lectivo->ano_lectivo,
        ];

        $data['where'] = [
            'id_turma' => $request->turma,
            'ano_lectivo' => $ano_lectivo->ano_lectivo,
        ];

        if (
            $data['store']['id_funcionario'] != $director->id_funcionario
            || $data['store']['id_turma'] != $director->id_turma ||
            $data['store']['ano_lectivo'] != $director->ano_lectivo
        ) {
            if (DirectorTurma::where($data['store'])->first()) {
                return back()->with(['error' => "Já cadastrou como Director"]);
            }

            if (DirectorTurma::where($data['where'])->first()) {
                return back()->with(['error' => "Esta turma já tem Director"]);
            }
        }

        if (DirectorTurma::find($id)->update($data['store'])) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
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
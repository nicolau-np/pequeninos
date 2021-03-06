<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\CompoDisciplina;
use App\Curso;
use App\Disciplina;
use App\Ensino;
use App\Grade;
use App\Hora;
use App\Sala;
use App\TipoSala;
use App\Turma;
use App\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Svg\Tag\Rect;

class InstitucionalController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function curso_list()
    {
        $cursos = Curso::paginate(5);
        $data = [
            'title' => "Cursos",
            'type' => "institucional",
            'menu' => "Cursos",
            'submenu' => "Listar",
            'getCursos' => $cursos,
        ];
        return view('institucional.cursos.list', $data);
    }
    public function curso_create()
    {
        $ensinos = Ensino::pluck('ensino', 'id');
        $data = [
            'title' => "Cursos",
            'type' => "institucional",
            'menu' => "Cursos",
            'submenu' => "Novo",
            'getEnsinos' => $ensinos,
        ];
        return view('institucional.cursos.new', $data);
    }
    public function curso_store(Request $request)
    {
        $request->validate([
            'ensino' => ['required', 'Integer'],
            'curso' => ['required', 'string', 'min:4', 'max:255']
        ]);

        $data = [
            'id_ensino' => $request->ensino,
            'curso' => $request->curso
        ];

        if (Curso::where($data)->first()) {
            return back()->with(['error' => "Já cadastrou este curso"]);
        }
        if (Curso::create($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }
    public function curso_edit($id)
    {
        $curso = Curso::find($id);
        if (!$curso) {
            return back()->with(['error' => "Não encontrou o curso"]);
        }
        $ensinos = Ensino::pluck('ensino', 'id');
        $data = [
            'title' => "Cursos",
            'type' => "institucional",
            'menu' => "Cursos",
            'submenu' => "Editar",
            'getCurso' => $curso,
            'getEnsinos' => $ensinos,
        ];
        return view('institucional.cursos.edit', $data);
    }
    public function curso_update(Request $request, $id)
    {
        $curso = Curso::find($id);
        if (!$curso) {
            return back()->with(['error' => "Não encontrou o curso"]);
        }
        $request->validate([
            'ensino' => ['required', 'Integer'],
            'curso' => ['required', 'string', 'min:4', 'max:255']
        ]);

        $data = [
            'id_ensino' => $request->ensino,
            'curso' => $request->curso
        ];
        if ($request->ensino != $curso->id_ensino || $request->curso != $curso->curso) {
            if (Curso::where($data)->first()) {
                return back()->with(['error' => "Já cadastrou este curso"]);
            }
        }

        if (Curso::find($id)->update($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }


    public function turma_list()
    {
        $turmas = Turma::paginate(5);
        $data = [
            'title' => "Turmas",
            'type' => "institucional",
            'menu' => "Turmas",
            'submenu' => "Listar",
            'getTurmas' => $turmas,
        ];
        return view('institucional.turmas.list', $data);
    }

    public function turma_create()
    {
        $cursos = Curso::pluck('curso', 'id');
        $turnos = Turno::pluck('turno', 'id');
        $data = [
            'title' => "Turmas",
            'type' => "institucional",
            'menu' => "Turmas",
            'submenu' => "Novo",
            'getCursos' => $cursos,
            'getTurnos' => $turnos
        ];
        return view('institucional.turmas.new', $data);
    }

    public function turma_store(Request $request)
    {
        $request->validate([
            'curso' => ['required', 'Integer'],
            'classe' => ['required', 'Integer'],
            'turno' => ['required', 'Integer'],
            'turma' => ['required', 'string', 'min:1', 'max:255']
        ]);

        $data = [
            'id_curso' => $request->curso,
            'id_classe' => $request->classe,
            'id_turno' => $request->turno,
            'turma' => $request->turma,
        ];
        if (Turma::where($data)->first()) {
            return back()->with(['error' => "Já cadastrou esta turma"]);
        }

        if (Turma::create($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function turma_edit($id)
    {
        $turma = Turma::find($id);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }
        $cursos = Curso::pluck('curso', 'id');
        $turnos = Turno::pluck('turno', 'id');
        $data = [
            'title' => "Turmas",
            'type' => "institucional",
            'menu' => "Turmas",
            'submenu' => "Editar",
            'getCursos' => $cursos,
            'getTurnos' => $turnos,
            'getTurma' => $turma
        ];
        return view('institucional.turmas.edit', $data);
    }

    public function turma_update(Request $request, $id)
    {
        $turma = Turma::find($id);
        if (!$turma) {
            return back()->with(['error' => "Não encontrou turma"]);
        }
        $request->validate([
            'curso' => ['required', 'Integer'],
            'classe' => ['required', 'Integer'],
            'turno' => ['required', 'Integer'],
            'turma' => ['required', 'string', 'min:1', 'max:255']
        ]);

        $data = [
            'id_curso' => $request->curso,
            'id_classe' => $request->classe,
            'id_turno' => $request->turno,
            'turma' => $request->turma,
        ];

        if (
            $request->curso != $turma->id_curso || $request->classe != $turma->id_classe ||
            $request->turno != $turma->id_turno || $request->turma != $turma->turma
        ) {
            if (Turma::where($data)->first()) {
                return back()->with(['error' => "Já cadastrou esta turma"]);
            }
        }

        if (Turma::find($id)->update($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }


    public function disciplina_list()
    {
        $disciplinas = Disciplina::paginate(5);
        $data = [
            'title' => "Disciplinas",
            'type' => "institucional",
            'menu' => "Disciplinas",
            'submenu' => "Listar",
            'getDisciplinas' => $disciplinas,
        ];
        return view('institucional.disciplinas.list', $data);
    }

    public function disciplina_create()
    {
        $componentes = CompoDisciplina::pluck('componente', 'id');
        $data = [
            'title' => "Disciplinas",
            'type' => "institucional",
            'menu' => "Disciplinas",
            'submenu' => "Novo",
            'getComponentes' => $componentes
        ];
        return view('institucional.disciplinas.new', $data);
    }

    public function disciplina_store(Request $request)
    {
        $request->validate([
            'componente' => ['required', 'Integer'],
            'disciplina' => ['required', 'string', 'min:3', 'max:255', 'unique:disciplinas,disciplina'],
            'sigla' => ['required', 'string', 'min:1', 'max:255'],
        ]);

        $data = [
            'id_componente' => $request->componente,
            'disciplina' => $request->disciplina,
            'sigla' => $request->sigla,
        ];

        if (Disciplina::where($data)->first()) {
            return back()->with(['error' => "Já cadastrou esta disciplina"]);
        }

        if (Disciplina::create($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function disciplina_edit($id)
    {
        $disciplina = Disciplina::find($id);
        if (!$disciplina) {
            return back()->with(['error' => "Não encontrou disciplina"]);
        }

        $componentes = CompoDisciplina::pluck('componente', 'id');
        $data = [
            'title' => "Disciplinas",
            'type' => "institucional",
            'menu' => "Disciplinas",
            'submenu' => "Editar",
            'getComponentes' => $componentes,
            'getDisciplina' => $disciplina
        ];
        return view('institucional.disciplinas.edit', $data);
    }

    public function disciplina_update(Request $request, $id)
    {
        $disciplina = Disciplina::find($id);
        if (!$disciplina) {
            return back()->with(['error' => "Não encontrou disciplina"]);
        }

        $request->validate([
            'componente' => ['required', 'Integer'],
            'disciplina' => ['required', 'string', 'min:3', 'max:255'],
            'sigla' => ['required', 'string', 'min:1', 'max:255'],
        ]);

        $data = [
            'id_componente' => $request->componente,
            'disciplina' => $request->disciplina,
            'sigla' => $request->sigla,
        ];

        if (
            $request->componente != $disciplina->id_componente || $request->disciplina != $disciplina->disciplina_create
            || $request->sigla != $disciplina->sigla
        ) {
            if (Disciplina::where($data)->first()) {
                return back()->with(['error' => "Já cadastrou esta disciplina"]);
            }
        }

        if (Disciplina::find($id)->update($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function grade_list()
    {
        $grade = Grade::paginate(5);
        $data = [
            'title' => "Grades Curricular",
            'type' => "institucional",
            'menu' => "Grades Curricular",
            'submenu' => "Listar",
            'getGrades' => $grade,
        ];
        return view('institucional.grades.list', $data);
    }

    public function grade_create()
    {
        $cursos = Curso::pluck('curso', 'id');
        $data = [
            'title' => "Grades Curricular",
            'type' => "institucional",
            'menu' => "Grades Curricular",
            'submenu' => "Novo",
            'getCursos' => $cursos,
        ];
        return view('institucional.grades.new', $data);
    }

    public function grade_store(Request $request)
    {
        $request->validate([
            'curso' => ['required', 'Integer'],
            'classe' => ['required', 'Integer'],
            'epoca' => ['required', 'string'],
        ]);

        if (!Session::has('disciplinas')) {
            return back()->with(['error' => "Deve selecionar disciplinas"]);
        }

        if (Session::get('disciplinas') == null) {
            return back()->with(['error' => "Deve selecionar disciplinas"]);
        }

        $data['store'] = [
            'id_curso' => $request->curso,
            'id_classe' => $request->classe,
            'id_disciplina' => null,
            'tipo' => $request->epoca,
        ];

        $data['where'] = [
            'id_curso' => $request->curso,
            'id_classe' => $request->classe,
            'id_disciplina' => null,
        ];

        foreach (Session::get('disciplinas') as $disciplina) {
            $data['store']['id_disciplina'] = $disciplina['id_disciplina'];
            $data['where']['id_disciplina'] = $disciplina['id_disciplina'];
            if (!Grade::where($data['where'])->first()) {
                $grade = Grade::create($data['store']);
            } else {
                $grade = false;
            }
        }

        if ($grade) {
            return back()->with(['success' => "Feito com sucesso"]);
        } else {
            return back()->with(['error' => "Já cadastrou"]);
        }
    }

    public function grade_edit($id)
    {
    }

    public function grade_update(Request $request, $id)
    {
    }

    public function sala_list(Request $request)
    {
        $salas = Sala::paginate(5);
        $data = [
            'title' => "Salas",
            'type' => "institucional",
            'menu' => "Salas",
            'submenu' => "Listar",
            'getSalas' => $salas,
        ];
        return view('institucional.salas.list', $data);
    }

    public function sala_create(Request $request)
    {
        $tipo_salas = TipoSala::pluck('tipo', 'id');
        $data = [
            'title' => "Salas",
            'type' => "institucional",
            'menu' => "Salas",
            'submenu' => "Novo",
            'getTipoSalas' => $tipo_salas,
        ];
        return view('institucional.salas.new', $data);
    }

    public function sala_store(Request $request)
    {
        $request->validate([
            'tipo_sala' => ['required', 'Integer'],
            'quant_estudantes' => ['required', 'Integer'],
            'sala' => ['required', 'string', 'min:1', 'max:255'],
        ]);

        $data = [
            'id_tipo_sala' => $request->tipo_sala,
            'quant_estudantes' => $request->quant_estudantes,
            'sala' => $request->sala,
        ];

        if (Sala::where(['id_tipo_sala' => $data['id_tipo_sala'], 'sala' => $data['sala']])->first()) {
            return back()->with(['error' => "Já cadastrou esta sala"]);
        }

        if (Sala::create($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function sala_edit($id)
    {
        $sala = Sala::find($id);
        if (!$sala) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $tipo_salas = TipoSala::pluck('tipo', 'id');
        $data = [
            'title' => "Salas",
            'type' => "institucional",
            'menu' => "Salas",
            'submenu' => "Novo",
            'getTipoSalas' => $tipo_salas,
            'getSala' => $sala
        ];
        return view('institucional.salas.edit', $data);
    }

    public function sala_update(Request $request, $id)
    {
        $sala = Sala::find($id);
        if (!$sala) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $request->validate([
            'tipo_sala' => ['required', 'Integer'],
            'quant_estudantes' => ['required', 'Integer'],
            'sala' => ['required', 'string', 'min:1', 'max:255'],
        ]);

        $data = [
            'id_tipo_sala' => $request->tipo_sala,
            'quant_estudantes' => $request->quant_estudantes,
            'sala' => $request->sala,
        ];

        if ($request->tipo_sala != $sala->id_tipo_sala || $request->sala != $sala->sala) {
            if (Sala::where(['id_tipo_sala' => $data['id_tipo_sala'], 'sala' => $data['sala']])->first()) {
                return back()->with(['error' => "Já cadastrou esta sala"]);
            }
        }

        if (Sala::find($sala->id)->update($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function hora_list()
    {
        $horas = Hora::paginate(5);
        $data = [
            'title' => "Horas",
            'type' => "institucional",
            'menu' => "Horas",
            'submenu' => "Listar",
            'getHoras' => $horas,
        ];
        return view('institucional.horas.list', $data);
    }

    public function hora_create()
    {
        $turnos = Turno::pluck('turno', 'id');
        $data = [
            'title' => "Horas",
            'type' => "institucional",
            'menu' => "Horas",
            'submenu' => "Novo",
            'getTurnos' => $turnos,
        ];
        return view('institucional.horas.new', $data);
    }

    public function hora_store(Request $request)
    {
        $request->validate([
            'turno' => ['required', 'Integer'],
            'hora_entrada' => ['required', 'string'],
            'hora_saida' => ['required', 'string'],
        ]);

        $data = [
            'id_turno' => $request->turno,
            'hora_entrada' => $request->hora_entrada,
            'hora_saida' => $request->hora_saida,
        ];

        if (Hora::where($data)->first()) {
            return back()->with(['error' => "Já cadastrou"]);
        }

        if (Hora::create($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function hora_edit($id)
    {
        $hora = Hora::find($id);
        if (!$hora) {
            return back()->with(['error' => "Nao encontrou"]);
        }
        $turnos = Turno::pluck('turno', 'id');
        $data = [
            'title' => "Horas",
            'type' => "institucional",
            'menu' => "Horas",
            'submenu' => "Novo",
            'getTurnos' => $turnos,
            'getHora' => $hora,
        ];
        return view('institucional.horas.edit', $data);
    }

    public function hora_update(Request $request, $id)
    {
        $hora = Hora::find($id);
        if (!$hora) {
            return back()->with(['error' => "Nao encontrou"]);
        }

        $request->validate([
            'turno' => ['required', 'Integer'],
            'hora_entrada' => ['required', 'string'],
            'hora_saida' => ['required', 'string'],
        ]);

        $data = [
            'id_turno' => $request->turno,
            'hora_entrada' => $request->hora_entrada,
            'hora_saida' => $request->hora_saida,
        ];

        if (
            $request->turno != $hora->id_turno || $request->hora_entrada != $hora->hora_entrada
            || $request->hora_saida != $hora->hora_saida
        ) {
            if (Hora::where($data)->first()) {
                return back()->with(['error' => "Já cadastrou"]);
            }
        }


        if (Hora::find($id)->update($data)) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function ano_lectivo_list()
    {
        $ano_lectivos = AnoLectivo::orderBy('id', 'desc')->paginate(8);
        $data = [
            'title' => "Ano Lectivo",
            'type' => "institucional",
            'menu' => "Ano Lectivo",
            'submenu' => "Listar",
            'getAnoLectivos' => $ano_lectivos,
        ];
        return view('institucional.ano_lectivo.list', $data);
    }

    public function ano_lectivo_create()
    {

        $data = [
            'title' => "Ano Lectivo",
            'type' => "institucional",
            'menu' => "Ano Lectivo",
            'submenu' => "Novo",
        ];
        return view('institucional.ano_lectivo.new', $data);
    }

    public function ano_lectivo_store(Request $request)
    {
        $request->validate([
            'ano_lectivo' => ['required', 'Integer'],
        ]);

        $data['ano'] = [
            'ano_lectivo' => $request->ano_lectivo,
        ];
        if (AnoLectivo::where($data['ano'])->first()) {
            return back()->with(['error' => "Já cadastrou este ano lectivo"]);
        }
        if (AnoLectivo::create($data['ano'])) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }

    public function ano_lectivo_edit($id)
    {
        $ano_lectivo = AnoLectivo::find($id);
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }
        $data = [
            'title' => "Ano Lectivo",
            'type' => "institucional",
            'menu' => "Ano Lectivo",
            'submenu' => "Editar",
            'getAnoLectivo' => $ano_lectivo,
        ];
        return view('institucional.ano_lectivo.edit', $data);
    }

    public function ano_lectivo_update(Request $request, $id)
    {
        $ano_lectivo = AnoLectivo::find($id);
        if (!$ano_lectivo) {
            return back()->with(['error' => "Não encontrou ano lectivo"]);
        }
        $request->validate([
            'ano_lectivo' => ['required', 'Integer'],
        ]);

        $data['ano'] = [
            'ano_lectivo' => $request->ano_lectivo,
        ];

        if ($request->ano_lectivo != $ano_lectivo->ano_lectivo) {
            if (AnoLectivo::where($data['ano'])->first()) {
                return back()->with(['error' => "Já cadastrou este ano lectivo"]);
            }
        }

        if (AnoLectivo::find($id)->update($data['ano'])) {
            return back()->with(['success' => "Feito com sucesso"]);
        }
    }
}
<div>
    <table>
        <tr>
            <td>id_funcionario</td>
            <td>id_turma</td>
            <td>id_disciplina</td>
            <td>estado</td>
            <td>ano_lectivo</td>
        </tr>

        @foreach ($getHorarios as $horarios)
        <tr>
            <td>{{$horarios->id_funcionario}}</td>
            <td>{{$horarios->id_turma}}</td>
            <td>{{$horarios->id_disciplina}}</td>
            <td>{{$horarios->estado}}</td>
            <td>{{$horarios->ano_lectivo}}</td>
        </tr>
        @endforeach
    </table>
</div>

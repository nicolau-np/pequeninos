<div>
    <table>
        <tr>
            <td>id_funcionario</td>
            <td>id_turma</td>
            <td>ano_lectivo</td>
        </tr>

        @foreach ($getDirectores as $directores)
        <tr>
            <td>{{$directores->id_funcionario}}</td>
            <td>{{$directores->id_turma}}</td>
            <td>{{$directores->ano_lectivo}}</td>
        </tr>
        @endforeach
    </table>
</div>

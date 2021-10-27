<div>
    <table>
        <tr>
            <td>id_curso</td>
            <td>id_classe</td>
            <td>id_disciplina</td>
            <td>tipo</td>
            <td>nuclear</td>
        </tr>

        @foreach ($getGrades as $grades)
            <tr>
                <td>{{ $grades->id_curso }}</td>
                <td>{{ $grades->id_classe }}</td>
                <td>{{ $grades->id_disciplina }}</td>
                <td>{{ $grades->tipo }}</td>
                <td>{{ $grades->nuclear }}</td>
            </tr>
        @endforeach
    </table>
</div>

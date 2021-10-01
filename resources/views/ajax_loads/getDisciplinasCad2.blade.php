<br/>
@foreach ($getGrade as $grade)
    <input type="checkbox" name="disciplinas[]" value="{{$grade->id_disciplina}}"> {{$grade->disciplina->disciplina}}<br/>
@endforeach


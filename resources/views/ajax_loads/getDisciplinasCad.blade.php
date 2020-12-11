<select name="disciplina" class="form-control">
    <option value="">Disciplina</option>
    @foreach ($getGrade as $grade)
    <option value="{{$grade->id_disciplina}}">{{$grade->disciplina->disciplina}}</option>
    @endforeach
</select>
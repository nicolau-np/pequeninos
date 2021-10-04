<div class="row">

    <div class="col-md-6">
       <table class="table table-bordered">
        <thead>
            <tr>
                <th>Disciplina</th>
                <th>Sígla</th>
                <th>Operações</th>
            </tr>
        </thead>
        <tbody class="load_disciplina">
            @foreach ($getGrades as $grades)
            <tr>
            <td scope="row">{{$grades->disciplina->disciplina}}</td>
            <td>{{$grades->disciplina->sigla}}</td>
            <td>
                <a href="#" class="btn btn-primary btn-sm adicionar" data-id="{{$grades->id_disciplina}}" data-sigla="{{$grades->disciplina->sigla}}"><i class="ti-plus" aria-hidden="true"></i></a>
            </td>
            </tr>
            @endforeach
          </tbody>
    </table>
    </div>
    <div class="col-md-6 load_selected">
      Nenhuma selecionada
    </div>

</div>


@endsection

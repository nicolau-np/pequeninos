
    <div class="col-md-12">
        <a href="#" class="btn btn-danger btn-sm float-right remover_todas"><i class="ti-trash" aria-hidden="true"></i></a>
    </div>
    <div class="col-md-12">
       <table class="table table-bordered">
        <thead>
            <tr>
                <th>Disciplina</th>
                <th>Add</th>
            </tr>
        </thead>
        <tbody class="load_disciplina">
            @foreach ($getGrades as $grades)
            <tr>
            <td scope="row">{{$grades->disciplina->disciplina}}</td>
            <td>
                <a href="#" class="btn btn-primary btn-sm adicionar" data-id="{{$grades->id_disciplina}}" data-sigla="{{$grades->disciplina->sigla}}"><i class="ti-plus" aria-hidden="true"></i></a>
            </td>
            </tr>
            @endforeach
          </tbody>
    </table>
    </div>

    <div class="col-md-12 load_selected">
        Nenhuma selecionada
    </div>



<script>
    $(document).ready(function(){

        disciplinas();

        $('.adicionar').click(function(e){
            e.preventDefault();
            var data = {
                id_disciplina: $(this).data('id'),
                sigla: $(this).data('sigla')
            };

            $.ajax({
                type: "get",
                url: "{{route('addDisciplinas')}}",
                data: data,
                dataType: "json",
                success: function (response) {
                    if(response.status === "ok"){
                        disciplinas();
                    }else if(response.status === "error"){
                        alert(response.sms);
                    }
                }
            });
        });

        $('.remover_todas').click(function(e){
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{route('removeDisciplinas')}}",
                data: null,
                dataType: "json",
                success: function (response) {
                    if(response.status === "ok"){
                        disciplinas();
                    }else if(response.status === "error"){
                        disciplinas();
                    }

                }
            });
        });

        function disciplinas(){
            $.ajax({
                type: "get",
                url: "{{route('getDisciplinasSelecionadas')}}",
                data: null,
                dataType: "html",
                success: function (response) {
                    $('.load_selected').html(response);
                }
            });
        }
    });
</script>

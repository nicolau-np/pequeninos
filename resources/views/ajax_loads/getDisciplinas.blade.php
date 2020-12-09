@foreach ($getDisciplinas as $disciplinas)
<tr>
    <td scope="row">{{$disciplinas->disciplina}}</td>
    <td>{{$disciplinas->sigla}}</td>
    <td>
    <a href="#" class="btn btn-primary btn-sm adicionar" data-id="{{$disciplinas->id}}" data-sigla="{{$disciplinas->sigla}}"><i class="ti-plus" aria-hidden="true"></i></a>
    </td>
</tr>    
@endforeach

<script>
    $(document).ready(function(){
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
                        
                    }else if(response.status === "error"){
                        alert(response.sms);
                    }
                }
            });
        });
    });
</script>
@foreach ($getFuncionarios as $funcionarios)

                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$funcionarios->pessoa->nome}}</td>
                                    <td>{{$funcionarios->pessoa->genero}}</td>
                                    <td>{{$funcionarios->cargo->cargo}}</td>
                                    <td>{{$funcionarios->escalao->escalao}}</td>
                                    <td>
                                        <a href="/horarios/create/{{$funcionarios->id}}" class="btn btn-success btn-sm"><i class="ti-time"></i> Hora.</a>
                                        <a href="/funcionarios/edit/{{$funcionarios->id}}" class="btn btn-primary btn-sm"><i class="ti-pencil-alt"></i> Editar</a>
                                        <a href="#" data-id_funcionario="{{$funcionarios->id}}" data-nome_funcionario="{{$funcionarios->pessoa->nome}}" class="btn btn-danger btn-sm delete"><i class="ti-trash"></i> Eliminar</a>
                                    </td>
                                </tr>

                                @endforeach
<script>
$('document').ready(function(){
    $('.delete').click(function(e){
            e.preventDefault();
            var data ={
                id_funcionario: $(this).data('id_funcionario'),
                nome_funcionario: $(this).data('nome_funcionario'),
                _token: "{{ csrf_token() }}"
            };

            $('.id_funcionario').val(data.id_funcionario);
            $('.nome_funcionario').text(data.nome_funcionario);
            $('#deletemodal').modal('show');
        });

        $('.cancel').click(function(e){
            e.preventDefault();
            $('#deletemodal').modal('hide');
        });
});
</script>

<?php
use App\Http\Controllers\ControladorStatic;
?>

@foreach ($getEstudantes as $estudantes)

                                <?php
                                $observacao_final = ControladorStatic::getObservacaofinal($estudantes->id, $estudantes->ano_lectivo);
                                ?>
                                <tr class="{{$observacao_final->observacao_final}}">
                                <th scope="row">{{$estudantes->id}}</th>
                                <td>
                                    <img src="
                                        @if($estudantes->pessoa->foto)
                                        {{asset($estudantes->pessoa->foto)}}
                                        @else
                                        {{asset('assets/template/images/profile.png')}}
                                        @endif
                                        " alt="" style="width:47px; height:47px; border-radius:4px;">
                                </td>
                                    <td>{{$estudantes->pessoa->nome}}</td>
                                    <td>{{$estudantes->turma->curso->curso}}</td>
                                    <td>{{$estudantes->turma->classe->classe}}</td>
                                    <td>{{$estudantes->turma->turno->turno}}</td>
                                    <td>{{$estudantes->turma->turma}}</td>
                                    <td>{{$estudantes->ano_lectivo}}</td>
                                    <td>
                                    <a href="/pagamentos/listar/{{$estudantes->id}}/{{$estudantes->ano_lectivo}}" class="btn btn-success btn-sm"><i class="ti-money"></i> Pag.</a>
                                    <a href="/estudantes/ficha/{{$estudantes->id}}/{{$estudantes->ano_lectivo}}" class="btn btn-warning btn-sm"><i class="ti-user"></i> Ficha</a>
                                    <a href="/estudantes/confirmar/{{$estudantes->id}}" class="btn btn-info btn-sm"><i class="ti-file"></i> Confir.</a>
                                    <a href="/estudantes/edit/{{$estudantes->id}}" class="btn btn-primary btn-sm"><i class="ti-pencil-alt"></i> Editar</a>
                                    <a href="#" data-id_estudante="{{$estudantes->id}}" data-nome_estudante="{{$estudantes->pessoa->nome}}" class="btn btn-danger btn-sm delete"><i class="ti-trash"></i> Eliminar</a>
                                    </td>
                                </tr>

                                @endforeach
<script>
$('document').ready(function(){
    $('.delete').click(function(e){
            e.preventDefault();
            var data ={
                id_estudante: $(this).data('id_estudante'),
                nome_estudante: $(this).data('nome_estudante'),
                _token: "{{ csrf_token() }}"
            };

            $('.id_estudante').val(data.id_estudante);
            $('.nome_estudante').text(data.nome_estudante);
            $('#deletemodal').modal('show');
        });

        $('.cancel').click(function(e){
            e.preventDefault();
            $('#deletemodal').modal('hide');
        });
});
</script>

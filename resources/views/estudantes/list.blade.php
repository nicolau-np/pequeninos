<?php
use App\Http\Controllers\ControladorStatic;
?>
@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}</h5>
                    <span></span>
                    <div class="card-header-right">

                        <ul class="list-unstyled card-option" style="width: 35px;">
                            <li class=""><i class="icofont icofont-simple-left"></i></li>
                            <li><i class="icofont icofont-maximize full-card"></i></li>
                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div class="form">
                        {{Form::open(['class'=>"form_search", 'method'=>"post", 'url'=>"#"])}}
                        <div class="row text-right">
                            <div class="col-md-8">
                                {{Form::text('text_search', null, ['class'=>"form-control text_search", 'placeholder'=>"Pesquisar..."])}}
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-success btn-sm"><i class="ti-search"></i></button>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>

                    <div class="table-responsive">
                        <br/>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width:47px;">Foto</th>
                                    <th>Nome</th>
                                    <th>Curso</th>
                                    <th>Classe</th>
                                    <th>Turno</th>
                                    <th>Turma</th>
                                    <th>Ano de Confirmação</th>
                                    <th>Operações</th>
                                </tr>
                            </thead>
                            <tbody class="load_estudantes">
                                @if($getEstudantes->count()==0)
                                <span class="not_found">Nenhum estudante cadastrado</span>
                                @else
                                @foreach ($getEstudantes as $estudantes)
                                <?php
                                $observacao_final = ControladorStatic::getObservacaofinal($estudantes->id, $estudantes->ano_lectivo);
                                ?>
                                <tr class="{{$observacao_final->observacao_final}}">
                                <th scope="row">{{$loop->iteration}}</th>
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
                                        <a href="http://" class="btn btn-danger btn-sm"><i class="ti-trash"></i> Eliminar</a>
                                    </td>
                                </tr>

                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">
                        {{$getEstudantes->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->
<div class="btnPesquisar">
	<div class="btnPesquisarBtn">
		<a href="/estudantes/create" class="btn btn-primary btnCircular btnPrincipal" title="Novo"><i class="ti-plus"></i></a>
	</div>
</div>

<script>
    $(document).ready(function(){
        $('.text_search').keyup(function(e){
            e.preventDefault();
            var data = {
                search_text: $(this).val(),
                _token: "{{ csrf_token() }}"
            };
            $.ajax({
                type: "post",
                url: "{{route('searchEstudantes')}}",
                data: data,
                dataType: "html",
                success: function (response) {
                    $('.load_estudantes').html(response);
                }
            });
        });

        $('.curso').change(function(e){
            e.preventDefault();
            var data = {
                id_curso: $(this).val(),
                _token: "{{ csrf_token() }}"
            }
            $.ajax({
                type: "post",
                url: "{{route('getClasses')}}",
                data: data,
                dataType: "html",
                success: function (response) {
                    $('.load_classes').html(response);
                }
            });
        });
    });
</script>
@endsection

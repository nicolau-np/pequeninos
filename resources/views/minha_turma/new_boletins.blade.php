@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}
                    <i class="ti-angle-right"></i>
                    {{$getDirector->turma->turma}}
                    <i class="ti-angle-right"></i>
                    {{$getDirector->turma->turno->turno}}
                    <i class="ti-angle-right"></i>
                    {{$getDirector->turma->curso->curso}}
                    <i class="ti-angle-right"></i>
                    {{$getDirector->ano_lectivo}}
                    </h5>
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

                    {{Form::open(['method'=>"put", 'url'=>"/relatorios/boletins/{$getDirector->id_turma}/{$getDirector->ano_lectivo}"])}}

                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif

                    <div class="row">
                        <div class="col-md-2">
                            {{Form::select('epoca', [
                                '1'=>"1 Trimestre",
                                '2'=>"2 Trimestre",
                                '3'=>"3 Trimestre",
                            ], null, ['class'=>"form-control", 'placeholder'=>"Epoca"])}}
                            <div class="erro">
                                @if($errors->has('epoca'))
                                <div class="text-danger">{{$errors->first('epoca')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-warning btn-sm float-left"><i class="ti-printer"></i>PDF</button>&nbsp;&nbsp;&nbsp;

                            <a href="#" class="btn btn-danger btn-sm float-right remover_todas"><i class="ti-trash" aria-hidden="true"></i></a>
                        </div>
                    </div>
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
                                @foreach ($getGrade as $grades)
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
                    {{Form::close()}}
                </div>

            </div>
        </div>
    </div>
</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->
<div class="btnPesquisar">
	<div class="btnPesquisarBtn">
		<a href="/minha_turma/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
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
@endsection

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
                   <div class="formulario">
                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                        {{Form::open(['method'=>"post", 'url'=>"/institucional/turmas/store"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados da turma</legend>
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('curso', "Curso")}} <span class="text-danger">*</span>
                                    {{Form::select('curso', $getCursos, null, ['class'=>"form-control curso", 'placeholder'=>"Curso"])}}
                                <div class="erro">
                                    @if($errors->has('curso'))
                                    <div class="text-danger">{{$errors->first('curso')}}</div>
                                    @endif
                                </div>
                                </div>

                                <div class="col-md-2">
                                    {{Form::label('classe', "Classe")}} <span class="text-danger">*</span>
                                    <span class="load_classes">
                                    {{Form::select('classe', [], null, ['class'=>"form-control", 'placeholder'=>"Classe"])}}
                                </span>
                                <div class="erro">
                                    @if($errors->has('classe'))
                                    <div class="text-danger">{{$errors->first('classe')}}</div>
                                    @endif
                                </div>
                                </div>

                                <div class="col-md-2">
                                    {{Form::label('turno', "Turno")}} <span class="text-danger">*</span>
                                    {{Form::select('turno', $getTurnos, null, ['class'=>"form-control", 'placeholder'=>"Turno"])}}

                                <div class="erro">
                                    @if($errors->has('turno'))
                                    <div class="text-danger">{{$errors->first('turno')}}</div>
                                    @endif
                                </div>
                                </div>

                                <div class="col-md-4">
                                    {{Form::label('turma', "Designação da turma")}} <span class="text-danger">*</span>
                                    {{Form::text('turma', null, ['class'=>"form-control", 'placeholder'=>"Designação da turma"])}}
                                    <div class="erro">
                                        @if($errors->has('turma'))
                                        <div class="text-danger">{{$errors->first('turma')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('sala', "Sala")}} 
                                    {{Form::text('sala', null, ['class'=>"form-control", 'placeholder'=>"Sala"])}}
                                    <div class="erro">
                                        @if($errors->has('sala'))
                                        <div class="text-danger">{{$errors->first('sala')}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br/>
                        </fieldset>
                        <br/>
                            <div class="row">
                                <div class="col-md-4">
                                    {{Form::submit('Salvar', ['class'=>"btn btn-primary"])}}
                                 </div>

                            </div>

                        {{Form::close()}}
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
		<a href="/institucional/turmas/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

<script>
    $(document).ready(function(){
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

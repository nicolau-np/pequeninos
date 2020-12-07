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
                        {{Form::open(['method'=>"put", 'url'=>"/institucional/salas/update/{$getSala->id}"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados da sala</legend>
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('tipo_sala', "Tipo de Salas")}} <span class="text-danger">*</span>
                                    {{Form::select('tipo_sala', $getTipoSalas, $getSala->id_tipo_sala, ['class'=>"form-control", 'placeholder'=>"Tipo de Salas"])}}
                                <div class="erro">
                                    @if($errors->has('tipo_sala'))
                                    <div class="text-danger">{{$errors->first('tipo_sala')}}</div>
                                    @endif 
                                </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('quant_estudantes', "Q. Estudantes")}} <span class="text-danger">*</span>
                                    {{Form::number('quant_estudantes', $getSala->quant_estudantes, ['class'=>"form-control", 'placeholder'=>"Q. Estudantes"])}}
                                    <div class="erro">
                                        @if($errors->has('quant_estudantes'))
                                        <div class="text-danger">{{$errors->first('quant_estudantes')}}</div>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('sala', "Sala")}} <span class="text-danger">*</span>
                                    {{Form::text('sala', $getSala->sala, ['class'=>"form-control", 'placeholder'=>"Sala"])}}
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
		<a href="/institucional/salas/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>


@endsection
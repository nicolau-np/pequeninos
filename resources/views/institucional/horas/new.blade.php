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
                        {{Form::open(['method'=>"post", 'url'=>"/institucional/horas/store"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados da hora</legend>
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('turno', "Turno")}} <span class="text-danger">*</span>
                                    {{Form::select('turno', $getTurnos, null, ['class'=>"form-control", 'placeholder'=>"Turno"])}}
                                <div class="erro">
                                    @if($errors->has('turno'))
                                    <div class="text-danger">{{$errors->first('turno')}}</div>
                                    @endif 
                                </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('hora_entrada', "Hora de Entrada")}} <span class="text-danger">*</span>
                                    {{Form::time('hora_entrada', null, ['class'=>"form-control", 'placeholder'=>"Hora de Entrada"])}}
                                    <div class="erro">
                                        @if($errors->has('hora_entrada'))
                                        <div class="text-danger">{{$errors->first('hora_entrada')}}</div>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('hora_saida', "Hora de Saída")}} <span class="text-danger">*</span>
                                    {{Form::time('hora_saida', null, ['class'=>"form-control", 'placeholder'=>"Hora de Saída"])}}
                                    <div class="erro">
                                        @if($errors->has('hora_saida'))
                                        <div class="text-danger">{{$errors->first('hora_saida')}}</div>
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
		<a href="/institucional/horas/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>


@endsection
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
                        {{Form::open(['method'=>"put", 'url'=>"/institucional/disciplinas/update/{$getDisciplina->id}"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados da disciplina</legend>
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('componente', "Componente")}} <span class="text-danger">*</span>
                                    {{Form::select('componente', $getComponentes, $getDisciplina->id_componente, ['class'=>"form-control", 'placeholder'=>"Componente"])}}
                                <div class="erro">
                                    @if($errors->has('componente'))
                                    <div class="text-danger">{{$errors->first('componente')}}</div>
                                    @endif 
                                </div>
                                </div>

                                <div class="col-md-4">
                                    {{Form::label('disciplina', "Disciplina")}} <span class="text-danger">*</span>
                                    {{Form::text('disciplina', $getDisciplina->disciplina, ['class'=>"form-control", 'placeholder'=>"Disciplina"])}}
                                    <div class="erro">
                                        @if($errors->has('disciplina'))
                                        <div class="text-danger">{{$errors->first('disciplina')}}</div>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('sigla', "Sígla")}} <span class="text-danger">*</span>
                                    {{Form::text('sigla', $getDisciplina->sigla, ['class'=>"form-control", 'placeholder'=>"Sígla"])}}
                                    <div class="erro">
                                        @if($errors->has('sigla'))
                                        <div class="text-danger">{{$errors->first('sigla')}}</div>
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
		<a href="/institucional/disciplinas/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>


@endsection
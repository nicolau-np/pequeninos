@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}
                        <i class="ti-angle-right"></i>
                    {{$getEstudante->pessoa->nome}}
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
                   <div class="formulario">
                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                        {{Form::open(['method'=>"put", 'url'=>"/estudantes/store_declaracao/{$getEstudante->id}"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados</legend>
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('tipo', "Tipo")}} <span class="text-danger">*</span>
                                    {{Form::select('tipo',[
                                        'sem nota'=>"sem nota",
                                        'com nota'=>"com nota",
                                    ], null, ['class'=>"form-control", 'placeholder'=>"Tipo"])}}
                                    <div class="erro">
                                        @if($errors->has('tipo'))
                                        <div class="text-danger">{{$errors->first('tipo')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('data', "Data de Emissão")}} <span class="text-danger">*</span>
                                    {{Form::date('data', null, ['class'=>"form-control", 'placeholder'=>"Data de Emissão"])}}
                                    <div class="erro">
                                        @if($errors->has('data'))
                                        <div class="text-danger">{{$errors->first('data')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('ano_lectivo', "Ano Lectivo")}} <span class="text-danger">*</span>
                                    {{Form::select('ano_lectivo', $getAnos, $getAno, ['class'=>"form-control", 'placeholder'=>"Ano Lectivo"])}}
                                    <div class="erro">
                                        @if($errors->has('ano_lectivo'))
                                        <div class="text-danger">{{$errors->first('ano_lectivo')}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    {{Form::label('motivo', "Finalidade")}} <span class="text-danger">*</span>
                                    {{Form::textarea('motivo', null, ['class'=>"form-control", 'placeholder'=>"Finalidade", 'cols'=>10, 'rows'=>4])}}
                                    <div class="erro">
                                        @if($errors->has('motivo'))
                                        <div class="text-danger">{{$errors->first('motivo')}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
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
		<a href="/estudantes/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>
@endsection

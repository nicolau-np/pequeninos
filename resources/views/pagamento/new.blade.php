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
                        {{Form::open(['method'=>"post", 'url'=>""])}}
                        @csrf
                        <fieldset>
                            <legend>
                                <b><i class="ti-user"></i> 
                                {{$getEstudante->pessoa->nome}}&nbsp;&nbsp;
                                </b>
                            </legend>
                            <div class="row">
                                <div class="col-md-3">
                                   {{Form::select('tipo_pagamento', $getTipPagamentos, null, [
                                       'placeholder'=>"Pagamento",
                                       'class'=>"form-control"
                                   ])}} 
                                </div>

                                <div class="col-md-2">
                                    {{Form::number('ano_lectivo',date('Y'), ['placeholder'=>"Ano Lectivo", 'class'=>"form-control"])}} 
                                 </div>

                                 <div class="col-md-2">
                                     {{Form::submit('Pesquisar', ['class'=>"btn btn-primary btn-sm"])}}
                                 </div>
                                </div>
                            <br/>
                        </fieldset>
                        <br/>
                          
                        
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
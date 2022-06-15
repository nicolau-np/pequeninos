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
                        {{Form::open(['method'=>"post", 'url'=>"/financas/saidas/store"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados da Saída</legend>
                            <div class="row">

                                <div class="col-md-4">
                                    {{Form::label('descricao', "Descrição")}} <span class="text-danger">*</span>
                                    {{Form::text('descricao', null, ['class'=>"form-control", 'placeholder'=>"Descrição da Saída"])}}
                                    <div class="erro">
                                        @if($errors->has('descricao'))
                                        <div class="text-danger">{{$errors->first('descricao')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('data_saida', "Data da Saída")}}
                                    {{Form::date('data_saida', null, ['class'=>"form-control", 'placeholder'=>"Data da Saída"])}}
                                    <div class="erro">
                                        @if($errors->has('data_saida'))
                                        <div class="text-danger">{{$errors->first('data_saida')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    {{Form::label('valor', "Valor")}} <span class="text-danger">*</span>
                                    {{Form::number('valor', null, ['class'=>"form-control", 'placeholder'=>"Valor"])}}
                                    <div class="erro">
                                        @if($errors->has('valor'))
                                        <div class="text-danger">{{$errors->first('valor')}}</div>
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
		<a href="/financas/saidas/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

@endsection

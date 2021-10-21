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
                        {{Form::open(['method'=>"post", 'url'=>"/financas/tipo_pagamentos/store"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados do Pagamento</legend>
                            <div class="row">
                                <div class="col-md-4">
                                    {{Form::label('tipo_pagamento', "Tipo de Pagamento")}} <span class="text-danger">*</span>
                                    {{Form::text('tipo_pagamento', null, ['class'=>"form-control", 'placeholder'=>"Tipo de Pagamento"])}}
                                    <div class="erro">
                                        @if($errors->has('tipo_pagamento'))
                                        <div class="text-danger">{{$errors->first('tipo_pagamento')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    {{Form::label('multa', "Multa")}} <span class="text-danger">*</span>
                                    {{Form::select('multa', [
                                        'sim'=>"sim",
                                        'nao'=>"nao",

                                    ], null, ['class'=>"form-control", 'placeholder'=>"Multa"])}}
                                    <div class="erro">
                                        @if($errors->has('multa'))
                                        <div class="text-danger">{{$errors->first('multa')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('dia_cobranca_multa', "Dia de Cobrança")}}
                                    {{Form::number('dia_cobranca_multa', null, ['class'=>"form-control", 'placeholder'=>"Dia de Cobrança"])}}
                                    <div class="erro">
                                        @if($errors->has('dia_cobranca_multa'))
                                        <div class="text-danger">{{$errors->first('dia_cobranca_multa')}}</div>
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
		<a href="/financas/tipo_pagamentos/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

@endsection

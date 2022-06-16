@php
use App\Http\Controllers\ControladorStatic;
@endphp
@extends('layouts.app')
@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $submenu }}
                            <i class="ti-angle-right"></i>

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

                        <div class="painelinfo">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>1º Trimestre</b>
                                    <br />
                                    - Setembro<br />
                                    - Outubro<br />
                                    - Novembro<br />
                                    - Dezembro<br /><br />
                                </div>
                                <div class="col-md-4">
                                    <b>2º Trimestre</b>
                                    <br />
                                    - Janeiro<br />
                                    - Fevereiro<br />
                                    - Março<br />
                                    - Abril
                                    <br /><br />

                                </div>
                                <div class="col-md-4">
                                    <b>3º Trimestre</b>
                                    <br />
                                    - Abril<br />
                                    - Maio<br />
                                    - Junho<br />

                                    <br /><br />
                                </div>

                            </div>
                        </div>

                        <div class="formulario">

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <div class="form">
                                {{ Form::open(['url' => '/estudantes/restringir', 'method' => 'post']) }}
                                <div class="row">
                                    <div class="col-md-3">
                                        {{ Form::label('tipo_pagamento', 'Tipo de Pagamento') }}
                                        {{ Form::select('tipo_pagamento', $getTipoPagamentos, null, ['class' => 'form-control', 'placeholder' => 'Tipo de Pagamento']) }}
                                        <div class="erro">
                                            @if ($errors->has('tipo_pagamento'))
                                                <div class="text-danger">{{ $errors->first('tipo_pagamento') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::label('ano_lectivo', 'Ano Lectivo') }}
                                        {{ Form::select('ano_lectivo', $getAnos, null, ['class' => 'form-control', 'placeholder' => 'Ano Lectivo']) }}
                                        <div class="erro">
                                            @if ($errors->has('ano_lectivo'))
                                                <div class="text-danger">{{ $errors->first('ano_lectivo') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        {{ Form::label('epoca', 'Trimestre') }}
                                        {{ Form::select(
    'epoca',
    [
        '1' => '1º Trimestre',
        '2' => '2º Trimestre',
        '3' => '3º Trimestre',
    ],
    null,
    ['class' => 'form-control', 'placeholder' => 'Trimestre'],
) }}
                                        <div class="erro">
                                            @if ($errors->has('epoca'))
                                                <div class="text-danger">{{ $errors->first('epoca') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <br />
                                        {{ Form::submit('Aplicar', ['class' => 'btn btn-primary']) }}
                                        &nbsp;&nbsp;
                                        <a href="/estudantes/restringir/destroy" class="btn btn-danger">Remover
                                            Restrições</a>
                                    </div>
                                </div>
                                {{ Form::close() }}
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
                <a href="/estudantes/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i
                        class="ti-arrow-left"></i></a>
            </div>
        </div>
    @endsection

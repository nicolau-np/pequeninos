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
                        <h5>{{ $submenu }} <i class="ti-angle-right"></i>

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
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                {{ Form::open(['method' => 'post', 'class' => 'form-balanco', 'url'=>"/relatorios/saidas"]) }}
                                <div class="row">
                                    <div class="col-md-4">
                                        {{ Form::label('data_inicial', 'De') }} <span class="text-danger">*</span>
                                        {{ Form::date('data_inicial', null, ['class' => 'form-control data_inicio', 'placeholder' => 'DataInicio']) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::label('data_final', 'Até') }} <span class="text-danger">*</span>
                                        {{ Form::date('data_final', null, ['class' => 'form-control data_fim', 'placeholder' => 'DataFim']) }}
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <br />
                                        {{ Form::submit('SEGUIR', ['class' => 'btn btn-primary']) }}
                                    </div>
                                </div>
                                {{ Form::close() }}

                            </div>


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
            <a href="/mapas/balancos" class="btn btn-primary btnCircular btnPrincipal" title="Voltar"><i
                    class="ti-arrow-left"></i></a>
        </div>
    </div>
    <!-- end-->

@endsection

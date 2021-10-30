@php
use App\Http\Controllers\ControladorStatic;

$meses = [9, 10, 11, 12, 1, 2, 3, 4, 5, 6, 7, 8];
$total = [
    'set' => 0,
    'out' => 0,
    'nov' => 0,
    'dez' => 0,
    'jan' => 0,
    'fev' => 0,
    'mar' => 0,
    'abr' => 0,
    'mai' => 0,
    'jun' => 0,
    'jul' => 0,
    'ago' => 0,
];

@endphp
@extends('layouts.app')
@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $submenu }} <i class="ti-angle-right"></i>
                            @foreach ($getAnos as $anos)
                                <a href="/mapas/balancos/categoria/{{ $anos->ano_lectivo }}"
                                    style="color:#4680ff;">{{ $anos->ano_lectivo }}</a>
                                <i class="ti-angle-right"></i>
                            @endforeach
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
                        <div>
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                        </div>
                        <div class="descricao">
                            Ano Lectivo: {{ $getAno }}
                        </div>
                        <div class="tabela">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tipos de Pagamentos</th>
                                        @foreach ($getCategorias as $categorias)
                                            <th style="text-align: center;">
                                                {{ $categorias->sigla }}
                                            </th>
                                        @endforeach
                                        <th>TOTAL</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getTipoPagamentos as $tipo_pagamentos)
                                        <tr>
                                            <td>{{ $tipo_pagamentos->tipo }}</td>
                                            @foreach ($getCategorias as $categorias)
                                                <td></td>
                                            @endforeach
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="grafico">

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

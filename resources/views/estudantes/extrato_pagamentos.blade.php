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
                            {{ $getHistorico->estudante->pessoa->nome }}
                            <i class="ti-angle-right"></i>
                            {{ $getHistorico->turma->turma }}
                            <i class="ti-angle-right"></i>
                            {{ $getHistorico->turma->turno->turno }}
                            <i class="ti-angle-right"></i>
                            {{ $getHistorico->turma->curso->curso }}
                            <i class="ti-angle-right"></i>
                            {{ $getHistorico->ano_lectivo }}
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
                                <div class="tabela">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Descrição</th>
                                                <th>Epoca</th>
                                                <th>Valor</th>
                                                <th>Multa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getPagamentos as $pagamentos)
                                                <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$pagamentos->tipo_pagamento->tipo}}</td>
                                                <td>{{$pagamentos->epoca}}</td>
                                                <td>{{number_format($pagamentos->preco,2,',','.')}}</td>
                                                <td>
                                                    @php
                                                    $valor_multa = 0;
                                                    $multa = ControladorStatic::getMultas($getHistorico->id_estudante, $pagamentos->id_tipo_pagamento, $pagamentos->epoca, $getHistorico->ano_lectivo);
                                                    if ($multa) {
                                                        $valor_multa = ($getTabelaPreco->preco * $multa->percentagem) / 100;
                                                    }
                                                    @endphp
                                                    {{number_format($valor_multa,2,',', '.')}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
            <a href="#" class="btn btn-primary btnCircular btnPrincipal" title="Novo"><i class="ti-plus"></i></a>
        </div>
    </div>


@endsection

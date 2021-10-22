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
                                    <div class="data">
                                        Data de Extração: {{date('d-m-Y H:i:s')}}
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Descrição</th>
                                                <th>Epoca ou Tipo</th>
                                                <th>Valor (Akz)</th>
                                                <th>Multa (Akz)</th>
                                                <th>Data de Pagamento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                                $total_multa = 0;
                                            @endphp
                                            @foreach ($getPagamentos as $pagamentos)
                                            @php
                                                $tabela_preco = ControladorStatic::getTabelaPreco($pagamentos->id_tipo_pagamento);
                                            @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $pagamentos->tipo_pagamento->tipo }}</td>
                                                    <td>
                                                        @if($tabela_preco->forma_pagamento == "Necessidade")

                                                        {{$pagamentos->tipo_pagamento->tipo}}
                                                        @else
                                                        {{ $pagamentos->epoca }}
                                                        @endif
                                                    </td>
                                                    <td>{{ number_format($pagamentos->preco, 2, ',', '.') }}</td>
                                                    <td>
                                                        @php
                                                            $total = $total + $pagamentos->preco;
                                                            $valor_multa = 0;
                                                            $multa = ControladorStatic::getMultasOFF($getHistorico->id_estudante, $pagamentos->id_tipo_pagamento, $pagamentos->epoca, $getHistorico->ano_lectivo);
                                                            if ($multa) {
                                                                $valor_multa = ($pagamentos->preco * $multa->percentagem) / 100;
                                                            }
                                                            $total_multa = $total_multa + $valor_multa;

                                                        @endphp
                                                        {{ number_format($valor_multa, 2, ',', '.') }}
                                                    </td>
                                                <td>{{date('d-m-Y H:i:s', strtotime($pagamentos->created_at))}}</td>
                                                </tr>
                                            @endforeach
                                            <tr style="font-weight: bold;">
                                                <td>TOTAL</td>
                                                <td>===</td>
                                                <td>===</td>
                                                <td>{{ number_format($total, 2, ',', '.') }}</td>
                                                <td>{{ number_format($total_multa, 2, ',', '.') }}</td>
                                                <td>===</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="total_geral" style="font-weight: bold; font-size:20px; color:#4680ff;">
                                        TOTAL GERAL: {{number_format(($total+$total_multa),2,',', '.')}} Akz
                                    </div>
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

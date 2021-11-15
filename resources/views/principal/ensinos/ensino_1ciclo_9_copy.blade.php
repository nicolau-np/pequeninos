@php
use App\Http\Controllers\ControladorNotas;
use App\Http\Controllers\ControladorStatic;
@endphp
@extends('layouts.app_principal')
@section('content')
    <style>
        .positivo {
            color: #4680ff;
            font-weight: bold;
        }

        .negativo {
            color: #FC6180;
            font-weight: bold;
        }

        .nenhum {
            color: #333;
            font-weight: bold;
        }

        fieldset {
            border: 1px solid #333;
            padding: 4px;
            font-size: 13px;
        }

        legend {
            padding: 4px;
            width: 30%;
            border: 1px solid #333;
            font-size: 13px;
            font-weight: bold;
            color:#4680ff;
        }

        @media(max-width:700px) {
            legend {
                padding: 4px;
                width: 60%;
                border: 1px solid #333;
                font-size: 13px;
            }

            fieldset {
                border: 0px solid #fff;
                padding: 4px;
                font-size: 13px;
            }
        }

    </style>
    <section id="dados" class="site-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-9" style="font-size:18px;">
                    <fieldset>
                        <legend>Dados Estudante</legend>
                        <b>Nome Completo:</b> {{ $getEstudante->pessoa->nome }}<br />
                        <b>Turma:</b> {{ $getEstudante->turma->turma }} [ {{ $getEstudante->turma->turno->turno }}
                        ]<br />
                        <b>Classe:</b> {{ $getEstudante->turma->classe->classe }}<br />
                        <b>Ano Lectivo:</b> {{ $getEstudante->ano_lectivo }}<br />
                    </fieldset>
                </div>
                <div class="col-md-3">
                    <img src="
                                                @if ($getEstudante->pessoa->foto) {{ asset($getEstudante->pessoa->foto) }}
                @else
                    {{ asset('assets/template/images/profile.png') }} @endif

                    " alt="" style="width:100%; height:28vh; border-radius: 5px;"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <br/>
                    <fieldset>
                        <legend>Aproveitamento e Notas</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">DISCIPLINA</th>
                                            <th>1º TRIM.</th>
                                            <th>2º TRIM.</th>
                                            <th>3º TRIM.</th>
                                        </tr>
                                        <tr>
                                            <th>MÉDIA</th>

                                            <th>MÉDIA</th>

                                            <th>MÉDIA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getGrades as $grades)

                                            <tr>
                                                <td>{{ $grades->disciplina->disciplina }}</td>
                                                @php
                                                    $trimestre1 = ControladorNotas::getValoresMiniPautaTrimestralPDF($grades->id_disciplina, $getEstudante->id, 1, $getEstudante->ano_lectivo);
                                                    $trimestre2 = ControladorNotas::getValoresMiniPautaTrimestralPDF($grades->id_disciplina, $getEstudante->id, 2, $getEstudante->ano_lectivo);
                                                    $trimestre3 = ControladorNotas::getValoresMiniPautaTrimestralPDF($grades->id_disciplina, $getEstudante->id, 3, $getEstudante->ano_lectivo);
                                                @endphp

                                                @if ($trimestre1->count() == 0)
                                                    <td>---</td>
                                                @else
                                                    @foreach ($trimestre1 as $valor1)
                                                        @php
                                                            $v1_estilo = ControladorNotas::nota_20($valor1->mt);
                                                        @endphp
                                                        <td class="{{ $v1_estilo }}">
                                                            @if ($valor1->mt == null) ---
                                                            @else {{ round($valor1->mt, 2) }} @endif
                                                        </td>
                                                    @endforeach
                                                @endif


                                                @if ($trimestre2->count() == 0)
                                                    <td>---</td>
                                                @else
                                                    @foreach ($trimestre2 as $valor2)
                                                        @php
                                                            $v2_estilo = ControladorNotas::nota_20($valor2->mt);
                                                        @endphp
                                                        <td class="{{ $v2_estilo }}">
                                                            @if ($valor2->mt == null) ---
                                                            @else {{ round($valor2->mt, 2) }} @endif
                                                        </td>
                                                    @endforeach
                                                @endif

                                                @if ($trimestre3->count() == 0)
                                                    <td>---</td>
                                                @else
                                                    @foreach ($trimestre3 as $valor3)
                                                        @php
                                                            $v3_estilo = ControladorNotas::nota_20($valor3->mt);
                                                        @endphp
                                                        <td class="{{ $v3_estilo }}">
                                                            @if ($valor3->mt == null) ---
                                                            @else {{ round($valor3->mt, 2) }} @endif
                                                        </td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>


<br/>
                    <fieldset>
                        <legend>Pagamentos efectuados</legend>
                        <div class="corpo">
                            <div class="table-resposive">
                                <table class="table table-bordered table-striped">
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
                                        @if ($getPagamentos->count() == 0)
                                            Nenhum pagamento efectuado para este ano lectivo
                                        @else
                                            @foreach ($getPagamentos as $pagamentos)
                                                @php
                                                    $tabela_preco = ControladorStatic::getTabelaPreco($pagamentos->id_tipo_pagamento);
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $pagamentos->tipo_pagamento->tipo }}</td>
                                                    <td>
                                                        @if ($tabela_preco->forma_pagamento == 'Necessidade')

                                                            {{ $pagamentos->tipo_pagamento->tipo }}
                                                        @else
                                                            {{ $pagamentos->epoca }}
                                                        @endif
                                                    </td>
                                                    <td>{{ number_format($pagamentos->preco, 2, ',', '.') }}</td>
                                                    <td>
                                                        @php
                                                            $total = $total + $pagamentos->preco;
                                                            $valor_multa = 0;
                                                            $multa = ControladorStatic::getMultasOFF($getEstudante->id, $pagamentos->id_tipo_pagamento, $pagamentos->epoca, $getEstudante->ano_lectivo);
                                                            if ($multa) {
                                                                $valor_multa = ($pagamentos->preco * $multa->percentagem) / 100;
                                                            }
                                                            $total_multa = $total_multa + $valor_multa;

                                                        @endphp
                                                        {{ number_format($valor_multa, 2, ',', '.') }}
                                                    </td>
                                                    <td>{{ date('d-m-Y H:i:s', strtotime($pagamentos->created_at)) }}
                                                    </td>
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
                                        @endif
                                    </tbody>
                                </table>
                                <span class="total_geral" style="font-weight: bold; font-size:18px; color:#4680ff;">
                                    TOTAL GERAL: {{ number_format($total + $total_multa, 2, ',', '.') }} Akz
                                </span>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </section>


@endsection

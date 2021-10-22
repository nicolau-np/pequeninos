@php
use App\Http\Controllers\ControladorStatic;
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LISTA DE {{ strtoupper($getTipoPagamento->tipo) }} - {{ $getAno }} [ {{ $getTurma->turma }} -
        {{ $getTurma->turno->turno }} - {{ $getTurma->curso->curso }} ] </title>
    <style>
        @page {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 10px;
        }

        table thead {
            background-color: #4680ff;
            color: #fff;
            font-weight: bold;
        }

        .mini-cabecalho {
            display: block;
        }

        .ano_curso {
            float: left;
        }

        .periodo {
            float: right;
        }

        .transferido {
            background-color: #FFB64D;
            color: #fff;
            font-weight: bold;
        }

        .desistencia {
            background-color: #FC6180;
            color: #fff;
            font-weight: bold;
        }

    </style>
</head>

<body>
    <div class="header">
        @include('include.header_docs')
    </div>

    <div class="titulo">
        <p style="text-align: center; font-weight:bold;">{{ strtoupper($getTipoPagamento->tipo) }}</p>
    </div>
    <div class="mini-cabecalho">
        <div class="ano_curso">
            {{ $getAno }} - [ {{ strtoupper($getTurma->turma) }} - {{ strtoupper($getTurma->curso->curso) }} ]
        </div>
        <div class="periodo">
            PERÍODO: {{ strtoupper($getTurma->turno->turno) }}<br />
        </div>
    </div>
    <br />

    <div class="body">
        @if ($getTipoPagamento->id == 3)
            <div class="tabela_comparticipacaoPais">
                <table class="table" border=1 cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                    <thead>
                        <tr class="tr_especial">
                            <th>Nº</th>
                            <th>ESTUDANTE</th>
                            <th>ENCARREGADO</th>
                            <th>TELEFONE</th>
                            @foreach ($getEpocasPagamento as $epocas)
                                <th>{{ strtoupper($epocas->epoca) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($getHistoricoEstudante as $histoEstudantes)
                            <tr class="{{ $histoEstudantes->observacao_final }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $histoEstudantes->estudante->pessoa->nome }}</td>
                                <td>
                                    @if ($histoEstudantes->estudante->encarregado->pessoa->nome == 'Encarregado Exemplo')
                                        Não informou
                                    @else
                                        {{ $histoEstudantes->estudante->encarregado->pessoa->nome }}
                                    @endif

                                </td>
                                <td>{{ $histoEstudantes->estudante->encarregado->pessoa->telefone }}</td>
                                <?php foreach ($getEpocasPagamento as $epocas) {
                                $comparticipacao =
                                ControladorStatic::getPagamentosComparticipacao($histoEstudantes->estudante->id_encarregado,
                                $epocas->epoca, $getAno); ?>
                                <td>
                                    @if ($comparticipacao == null)
                                        --
                                    @else
                                        {{ number_format($comparticipacao->preco, 2, ',', '.') }} Akz
                                    @endif
                                </td>
                                <?php
                                } ?>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>


        @else
            <div class="tabela_propina">
                <table class="table" class="table" border=1 cellspacing=0 cellpadding=2 bordercolor="#000"
                    style="width: 100%;">
                    <thead>
                        <tr class="tr_especial">
                            <th>Nº</th>
                            <th>ESTUDANTE</th>
                            @if ($getTabelaPreco->forma_pagamento == 'Necessidade')
                                <th>Valor</th>
                            @else
                                @foreach ($getEpocasPagamento as $epocas)
                                    <th>{{ strtoupper($epocas->epoca) }}</th>
                                @endforeach
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getHistoricoEstudante as $histoEstudantes)
                            <tr class="{{ $histoEstudantes->observacao_final }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $histoEstudantes->estudante->pessoa->nome }}</td>
                                @foreach ($getEpocasPagamento as $epocas)
                                    @php
                                        $pagamento = ControladorStatic::getPagamentos($histoEstudantes->id_estudante, $epocas->epoca, $getAno);

                                    @endphp
                                    <td>
                                        @if ($pagamento == null)
                                            ===
                                        @else
                                            @if ($getTabelaPreco->tipo_pagamento->multa == 'sim')
                                                @php
                                                    $valor_multa = 0;
                                                    $multa = ControladorStatic::getMultasOFF($histoEstudantes->id_estudante, $pagamento->id_tipo_pagamento, $pagamento->epoca, $histoEstudantes->ano_lectivo);
                                                    if ($multa) {
                                                        $valor_multa = ($pagamento->preco * $multa->percentagem) / 100;
                                                    }
                                                @endphp
                                            @endif
                                            {{ number_format($pagamento->preco, 2, ',', '.') }} Akz
                                            @if($valor_multa!=0 || $valor_multa!="")
                                            <span style="color:red;">+ {{number_format($valor_multa,2,',','.')}} Akz</span>
                                            @endif

                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif
    </div>

</body>

</html>

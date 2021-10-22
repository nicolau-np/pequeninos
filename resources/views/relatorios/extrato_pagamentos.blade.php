@php
use App\Http\Controllers\ControladorStatic;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EXTRATO PAGAMENTOS - [ {{ strtoupper($getHistorico->estudante->pessoa->nome) }} -
        {{ $getHistorico->ano_lectivo }} ]</title>
    <style>
        @page {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 10px;
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

        table thead {
            background-color: #4680ff;
            color: #fff;
        }

        .tabela {
            font-size: 12px;
        }

    </style>
</head>

<body>
    <div class="cabecalho">
        @include('include.header_docs')
    </div>
    <div class="titulo">
        <p style="text-align: center; font-weight:bold;">EXTRATO</p>
     </div>

     <div class="mini-cabecalho">
        <div class="ano_curso">
            {{$getHistorico->ano_lectivo}} - [ {{strtoupper($getHistorico->estudante->pessoa->nome)}} - {{strtoupper($getHistorico->turma->turma)}} - {{strtoupper($getHistorico->turma->curso->curso)}}]
        </div>
        <div class="periodo">
            PERÍODO: {{strtoupper($getHistorico->turma->turno->turno)}}<br/>
        </div>
     </div>
     <br/>
     <div class="corpo">
        <div class="table-resposive">
            <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
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
            <span class="total_geral" style="font-weight: bold; font-size:18px; color:#4680ff;">
                TOTAL GERAL: {{number_format(($total+$total_multa),2,',', '.')}} Akz
            </span>
        </div>
     </div>

     <div class="footer">
        Data de Extração: {{date('d-m-Y H:i:s')}}
     </div>
</body>

</html>

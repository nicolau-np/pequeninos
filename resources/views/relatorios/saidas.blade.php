<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SAÍDAS REFERENTES [{{ $data_inicial }} {{ $data_final }}]</title>
    <style>
        @page {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
        }

        tbody tr td {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <br />
        <div class="titulo">
            <p style="text-align: center; font-weight:bold; font-size:15px;">MAPA DE CONTROLO DE SAÍDAS</p>
        </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                De: {{ date('d-m-Y', strtotime($data_inicial)) }}<br />
                Até: {{ date('d-m-Y', strtotime($data_final)) }}
            </div>

        </div>
        <br />
        <div class="corpo">
            <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Data</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                @foreach ($getSaidas as $saidas)
                    <tbody>
                        <tr>
                            <td>{{ $saidas->descricao }}</td>
                            <td>{{ date('d-m-Y', strtotime($saidas->data_saida)) }}</td>
                            <td>{{ number_format($saidas->valor, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            <div class="total" style="font-weight: bold; font-size:18px;">
                Total Geral: {{ number_format($getSaidas->sum('valor'), 2, ',', '.') }}
            </div>
        </div>
    </div>
</body>

</html>

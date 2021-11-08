@php
use App\Http\Controllers\ControladorStatic;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BALANÇO - [ {{ date('d-m-Y', strtotime($data1)) }} - {{ date('d-m-Y', strtotime($data2)) }} ]</title>
    <style>
        @page {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;

        }

        .page-break {
            page-break-before: always;
        }

        table thead {
            background-color: #4680ff;
            color: #fff;
        }

        .tabela {
            font-size: 12px;
        }

        .mini-cabecalho {
            display: block;
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
            <p style="text-align: center; font-weight:bold; font-size:15px;">BALANÇO</p>
        </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
               De: {{date('d-m-Y', strtotime($data1))}}<br/>
               Até: {{ date('d-m-Y', strtotime($data2)) }}
            </div>

        </div>
        <br />
        <div class="corpo">
            <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Tipo de Pagamento</th>
                        <th>Valor</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($getTiposPagamentos as $tipo_pagamentos)
                        <tr>
                            <td>{{ $tipo_pagamentos->tipo }}</td>
                            <td>
                                @php
                                    $total = 0;
                                    $pagamento_diario = ControladorStatic::getBalanco($data1, $data2, $tipo_pagamentos->id);
                                    foreach ($pagamento_diario as $pag_diario) {
                                        $total = $total + $pag_diario->preco;
                                    }
                                @endphp
                                {{ number_format($total, 2, ',', '.') }} Akz
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
        <br/>
        <div class="rodape">

        </div>
    </div>
</body>

</html>

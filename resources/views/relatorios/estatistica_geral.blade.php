@php
use App\Http\Controllers\ControladorStatic;

$total = [
    'mf' => 0,
    'm' => 0,
    'f' => 0,
];
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ESTATÍSTICA GERAL [ {{ $getAno }} ]</title>
    <style>
        @page {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
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
            font-size: 10px;
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
    <div class="cabecalho">
        @include('include.header_docs')
    </div>
    <div class="titulo">
        <p style="text-align: center; font-weight:bold; font-size:15px;">ESTATÍSTICA GERAL</p>
    </div>
    <div class="mini-cabecalho">
        <div class="ano_curso">
            Ano Lectivo: {{ $getAno }}
        </div>
        <div class="periodo">
            <br />
        </div>
    </div>
    <br />
    <div class="corpo">
        <div class="table-resposive">
            <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                <thead>
                    <tr>
                        <th>TURMAS</th>
                        @foreach ($getCategorias as $categorias)
                            <th colspan="3">{{ strtoupper($categorias->categoria) }}</th>
                        @endforeach
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        @foreach ($getCategorias as $categorias)
                            <td>M</td>
                            <td>F</td>
                            <td>TOTAL</td>
                        @endforeach

                    </tr>

                    @foreach ($getTurmas as $turmas)
                        @php
                            $total['mf'] = 0;
                            $total['f'] = 0;
                            $total['m'] = 0;
                        @endphp
                        <tr>
                            <td style="width:100px;">{{ strtoupper($turmas->classe->classe) }} [ {{ $turmas->turma }}
                                ]</td>
                            @foreach ($getCategorias as $categorias)
                                @php
                                    $total['mf'] = 0;
                                    $total['f'] = 0;
                                    $total['m'] = 0;
                                @endphp
                                <td>{{$total['m']}}</td>
                                <td>{{$total['f']}}</td>
                                <td>{{$total['mf']}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    <tr>
                        <td>TOTAL</td>
                        @foreach ($getCategorias as $categorias)
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

@php
use App\Http\Controllers\ControladorStatic;

$total = [
    'mf' => 0,
    'm' => 0,
    'f' => 0,
];

$total_escola = [
    'mf' => 0,
    'm' => 0,
    'f' => 0,
];

$total_categoria = [
    'mf' => 0,
    'm' => 0,
    'f' => 0,
];

$total_geral = [
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
            font-size: 11px;
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
            font-size: 11px;
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
                        <th colspan="3">TOTAL DE ALUNOS NA ESCOLA</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        @foreach ($getCategorias as $categorias)
                            <th>M</th>
                            <th>F</th>
                            <th>TOTAL</th>
                        @endforeach
                        <th>M</th>
                        <th>F</th>
                        <th>TOTAL</th>

                    </tr>

                    @foreach ($getTurmas as $turmas)
                        @php
                            $total['mf'] = 0;
                            $total['f'] = 0;
                            $total['m'] = 0;

                            $total_escola['mf'] = 0;
                            $total_escola['f'] = 0;
                            $total_escola['m'] = 0;
                            $total_historico = ControladorStatic::getTotalTurma($turmas->id, $getAno);
                            if ($total_historico->count() >= 1) {
                                foreach ($total_historico as $total_h) {
                                    $total_escola['mf']++;
                                    if ($total_h->estudante->pessoa->genero == 'F') {
                                        /*femenino*/
                                        $total_escola['f']++;
                                    } elseif ($total_h->estudante->pessoa->genero == 'M') {
                                        /*masculino*/
                                        $total_escola['m']++;
                                    }
                                }
                            }

                        @endphp
                        <tr>
                            <td style="width:100px;">{{ strtoupper($turmas->classe->classe) }} [
                                {{ $turmas->turma }}
                                ]</td>
                            @foreach ($getCategorias as $categorias)
                                @php
                                    $total['mf'] = 0;
                                    $total['f'] = 0;
                                    $total['m'] = 0;

                                    $historico = ControladorStatic::getTotalCategoriaTurma($turmas->id, $categorias->sigla, $getAno);
                                    if ($historico->count() >= 1) {
                                        foreach ($historico as $h) {
                                            /*total*/
                                            $total['mf']++;
                                            /*femeninos*/
                                            if ($h->estudante->pessoa->genero == 'F') {
                                                $total['f']++;
                                            } elseif ($h->estudante->pessoa->genero == 'M') {
                                                $total['m']++;
                                            }
                                        }
                                    }

                                @endphp
                                <td>{{ $total['m'] }}</td>
                                <td>{{ $total['f'] }}</td>
                                <td>{{ $total['mf'] }}</td>
                            @endforeach
                            <td>{{ $total_escola['m'] }}</td>
                            <td>{{ $total_escola['f'] }}</td>
                            <td>{{ $total_escola['mf'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th>TOTAL</th>
                        @foreach ($getCategorias as $categorias)
                            @php
                                $total_categoria['mf'] = 0;
                                $total_categoria['f'] = 0;
                                $total_categoria['m'] = 0;
                                $total_cat = ControladorStatic::getTotalCategoria($categorias->sigla, $getAno);
                                if ($total_cat->count() >= 1) {
                                    foreach ($total_cat as $total_c) {
                                        $total_categoria['mf']++;
                                        if ($total_c->estudante->pessoa->genero == 'F') {
                                            $total_categoria['f']++;
                                        } elseif ($total_c->estudante->pessoa->genero == 'M') {
                                            $total_categoria['m']++;
                                        }
                                    }
                                }
                            @endphp
                            <th>{{ $total_categoria['m'] }}</th>
                            <th>{{ $total_categoria['f'] }}</th>
                            <th>{{ $total_categoria['mf'] }}</th>
                        @endforeach

                        @php
                            $total_getal['mf'] = 0;
                            $total_getal['f'] = 0;
                            $total_getal['m'] = 0;
                            $total_g = ControladorStatic::getTotal($getAno);
                            if ($total_g->count() >= 1) {
                                foreach ($total_g as $tot_g) {
                                    $total_geral['mf']++;
                                    if ($tot_g->estudante->pessoa->genero == 'F') {
                                        $total_geral['f']++;
                                    } elseif ($tot_g->estudante->pessoa->genero == 'M') {
                                        $total_geral['m']++;
                                    }
                                }
                            }
                        @endphp
                        <th>{{ $total_geral['m'] }}</th>
                        <th>{{ $total_geral['f'] }}</th>
                        <th>{{ $total_geral['mf'] }}</th>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

@php
use App\Http\Controllers\ControladorNotas;
use App\Http\Controllers\ControladorStatic;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PAUTA DO {{ $getEpoca }}º TRIMESTRE - {{ $getAno }}
        [{{ strtoupper($getTurma->turma) }}-{{ strtoupper($getTurma->turno->turno) }}-{{ strtoupper($getTurma->curso->curso) }}
        ]</title>
    <style>
        @page {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9px;
            margin-left: 10px;
            margin-right: 10px;
            margin-top: 10px;
            margin-bottom: 10px;

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

        .positivo {
            color: #4680ff;
        }

        .negativo {
            color: #FC6180;
        }

        .nenhum {
            color: #333;
        }

        table thead {
            background-color: #4680ff;
            color: #fff;
        }

        table tbody tr td {
            border: 1px solid #333;
        }

        .tabela {
            font-size: 9px;
        }

        .teacher_name {
            text-align: center;
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

        .td_color {
            background-color: #badaf1;
            font-weight: bold;
        }

    </style>
</head>

<body>

    <!-- segunda pagina -->
    <div class="page-break">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold;">PAUTA DO {{ $getEpoca }}º TRIMESTRE</p>
        </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                &nbsp;&nbsp;{{ $getAno }} - [ {{ strtoupper($getTurma->turma) }} -
                {{ strtoupper($getTurma->curso->curso) }} ]

            </div>
            <div class="periodo">
                PERÍODO: {{ strtoupper($getTurma->turno->turno) }}
                &nbsp;&nbsp;
                <br />
            </div>
        </div>
        <br />
        <div class="corpo">

            <div class="table-responsive tabela">
                @if (!$getOrdenaDisciplinas)
                    <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;"
                        bordercolor="red">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>NOME COMPLETO</th>
                                <th>G</th>
                                <?php
                                $count_disciplinas = 0;
                                foreach (Session::get('disciplinas') as $disciplina) {

                                $count_disciplinas++;
                                $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                                ?>
                                <th>{{ strtoupper($getDisciplina->disciplina) }}</th>
                                <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getHistorico as $historico)
                                <tr class="{{ $historico->observacao_final }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $historico->estudante->pessoa->nome }}</td>
                                    <td>{{ $historico->estudante->pessoa->genero }}</td>

                                    <?php foreach (Session::get('disciplinas') as $disciplina) {
                                    $restricao = ControladorStatic::getRestricao($getEpoca, $getAno,
                                    $historico->id_estudante);
                                    $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                                    $getValoresMiniPautaTrimestralPDF =
                                    ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina['id_disciplina'],
                                    $historico->id_estudante, $getEpoca, $getAno);
                                    if ($restricao) { ?>
                                    <td>DEVEDOR</td>
                                    <?php } else {if ($getValoresMiniPautaTrimestralPDF->count() == 0) {
                                    ?>
                                    <td>---</td>
                                    <?php } else {foreach ($getValoresMiniPautaTrimestralPDF as $valor) {
                                    $v1_estilo = ControladorNotas::nota_20($valor->mt); ?>
                                    <td class="{{ $v1_estilo }}">
                                    @if ($valor->mt == null) --- @else
                                            {{ round($valor->mt, 2) }} @endif
                                    </td>
                                    <?php
                                    }}}
                                    } ?>
                                    <!-- primeiro trimestre-->

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;"
                        bordercolor="red">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>NOME COMPLETO</th>
                                <th>G</th>
                                <?php
                                $count_disciplinas = 0;
                                foreach ($getOrdenaDisciplinas as $disciplina) {

                                $count_disciplinas++;
                                $getDisciplina = ControladorStatic::getDisciplinaID($disciplina->id_disciplina);
                                ?>
                                <th>{{ strtoupper($getDisciplina->disciplina) }}</th>
                                <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getHistorico as $historico)
                                <tr class="{{ $historico->observacao_final }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $historico->estudante->pessoa->nome }}</td>
                                    <td>{{ $historico->estudante->pessoa->genero }}</td>

                                    <?php foreach ($getOrdenaDisciplinas as $disciplina) {
                                    $restricao = ControladorStatic::getRestricao($getEpoca, $getAno,
                                    $historico->id_estudante);
                                    $getDisciplina = ControladorStatic::getDisciplinaID($disciplina->id_disciplina);
                                    $getValoresMiniPautaTrimestralPDF =
                                    ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina->id_disciplina,
                                    $historico->id_estudante, $getEpoca, $getAno);
                                    if ($restricao) { ?>
                                    <td>DEVEDOR</td>
                                    <?php } else {if ($getValoresMiniPautaTrimestralPDF->count() == 0) {
                                    ?>
                                    <td>---</td>
                                    <?php } else {foreach ($getValoresMiniPautaTrimestralPDF as $valor) {
                                    $v1_estilo = ControladorNotas::nota_20($valor->mt); ?>
                                    <td class="{{ $v1_estilo }}">
                                    @if ($valor->mt == null) --- @else
                                            {{ round($valor->mt, 2) }} @endif
                                    </td>
                                    <?php
                                    }}}
                                    } ?>
                                    <!-- primeiro trimestre-->

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>

        </div>
        <br /><br />
        <div class="rodape">
            <div class="teacher_name">
                O Director da escola<br />
                -------------------------------------------------<br />
                Aurélio Messele Tchissende
            </div>
        </div>
    </div>
    <!-- end segunda pagina -->

</body>

</html>

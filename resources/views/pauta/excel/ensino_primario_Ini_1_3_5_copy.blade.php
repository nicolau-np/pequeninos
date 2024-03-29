@php
use App\Http\Controllers\ControladorNotas;
use App\Http\Controllers\ControladorStatic;
$numero_colspan = 2;
$getCadeiraExame = false;
$getCadeiraRecurso = false;
$cadeiras_nulas = 0;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PAUTA {{ $getDirector->ano_lectivo }} [
        {{ strtoupper($getDirector->turma->turma) }}-{{ strtoupper($getDirector->turma->turno->turno) }}-{{ strtoupper($getDirector->turma->curso->curso) }}
        ]</title>


    <style>
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

        .neutro {
            color: #FFB64D;
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
            display: block;
        }

        .subdirector {
            float: left;
            text-align: center;
        }

        .director {
            float: right;
            text-align: center;
        }

        .directorTurma {
            text-align: center;
            float: center;
        }

        .td_color {
            background-color: #e2dfd3;
            font-weight: bold;
        }

        .positivotd_color {
            background-color: #e2dfd3;
            color: #4680ff;
            font-weight: bold;
        }

        .negativotd_color {
            background-color: #e2dfd3;
            color: #FC6180;
            font-weight: bold;
        }

        .positivo .td_color {
            background-color: #e2dfd3;
            color: #4680ff;
            font-weight: bold;
        }

        .negativo .td_color {
            background-color: #e2dfd3;
            color: #FC6180;
            font-weight: bold;
        }

        .neutro .td_color{
            color: #FFB64D;
            background-color: #e2dfd3;
            font-weight: bold;
        }

        .neutrotd_color{
            color: #FFB64D;
            background-color: #e2dfd3;
            font-weight: bold;
        }



    </style>
</head>


<body>

    <div class="default-page">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold;">MAPA DE AVALIAÇÃO ANUAL</p>
        </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                &nbsp;&nbsp;{{ $getDirector->ano_lectivo }} - [ {{ strtoupper($getDirector->turma->turma) }} -
                {{ strtoupper($getDirector->turma->curso->curso) }} ]
            </div>
            <div class="periodo">
                PERÍODO: {{ strtoupper($getDirector->turma->turno->turno) }}
                &nbsp;&nbsp;
                <br />

            </div>
        </div>
        <br />
        <div class="corpo">
            <div class="table-responsive tabela">
                @if (!$getOrdenaDisciplinas)
                    <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000"
                        style="width: 100%;">
                        <thead>

                            <tr>
                                <th rowspan="2">Nº</th>
                                <th rowspan="2">NOME COMPLETO</th>
                                <th rowspan="2">G</th>
                                <?php foreach (Session::get('disciplinas') as $disciplina) {

                                $numero_colspan = 2;
                                $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                                $getCadeiraExame = ControladorStatic::getExameStatus($getDirector->turma->id_curso,
                                $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                $getCadeiraRecurso = ControladorStatic::getRecursoStatus($getDirector->turma->id_curso,
                                $getDirector->turma->id_classe, $disciplina['id_disciplina']);

                                if ($getCadeiraExame) {
                                $numero_colspan = $numero_colspan + 1;
                                }

                                if (!$getCadeiraExame) {
                                $numero_colspan = 4;
                                }

                                if ($getCadeiraRecurso) {
                                $numero_colspan = $numero_colspan + 1;
                                }
                                ?>
                                <th colspan="{{ $numero_colspan }}">{{ strtoupper($getDisciplina->disciplina) }}
                                </th>
                                <?php
                                } ?>
                                <th rowspan="2">OBSERVAÇÃO</th>
                            </tr>
                            <tr>
                                @foreach (Session::get('disciplinas') as $disciplina)
                                    <?php
                                    $getCadeiraExame = ControladorStatic::getExameStatus($getDirector->turma->id_curso,
                                    $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                    $getCadeiraRecurso =
                                    ControladorStatic::getRecursoStatus($getDirector->turma->id_curso,
                                    $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                    ?>
                                    @if (!$getCadeiraExame)
                                        <th>MT1</th>
                                        <th>MT2</th>
                                        <th>MT3</th>
                                    @endif
                                    <th>MFD</th>
                                    @if ($getCadeiraExame)
                                        <th>NPE</th>
                                        <th>MF</th>
                                    @endif

                                    @if ($getCadeiraRecurso)
                                        <th>REC</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($getHistorico as $historico)
                                @php
                                    $cadeiras_nulas = 0;
                                @endphp

                                <tr class="{{ $historico->observacao_final }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $historico->estudante->pessoa->nome }}</td>
                                    <td>{{ $historico->estudante->pessoa->genero }}</td>

                                    <?php foreach (Session::get('disciplinas') as $disciplina) {
                                    $getCadeiraExame = ControladorStatic::getExameStatus($getDirector->turma->id_curso,
                                    $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                    $getCadeiraRecurso =
                                    ControladorStatic::getRecursoStatus($getDirector->turma->id_curso,
                                    $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                    $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante,
                                    $disciplina['id_disciplina'], $getDirector->ano_lectivo);

                                    $trimestre1 =
                                    ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina['id_disciplina'],
                                    $historico->id_estudante, 1, $getDirector->ano_lectivo);
                                    $trimestre2 =
                                    ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina['id_disciplina'],
                                    $historico->id_estudante, 2, $getDirector->ano_lectivo);
                                    $trimestre3 =
                                    ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina['id_disciplina'],
                                    $historico->id_estudante, 3, $getDirector->ano_lectivo);
                                    if ($final->count() == 0) { ?>
                                    @if (!$getCadeiraExame)
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    @endif

                                    @php
                                        $td1 = null;
                                        if (!$getCadeiraExame) {
                                            $td1 = 'td_color';
                                        }
                                    @endphp


                                    <td class="{{ $td1 }}">---</td>
                                    @if ($getCadeiraExame)
                                        <td>---</td>
                                        <td class="td_color">---</td>
                                    @endif

                                    @if ($getCadeiraRecurso)
                                        <td>---</td>
                                    @endif
                                    <?php } else { ?>

                                    @if (!$getCadeiraExame)

                                        <!-- primiero trimestre-->
                                        <?php if ($trimestre1->count() == 0) { ?>
                                        @php
                                            $cadeiras_nulas++;
                                        @endphp
                                        <td>---</td>
                                        <?php } else {foreach ($trimestre1 as $valor1) {

                                        $v4_estilo = ControladorNotas::nota_10Qualitativa($valor1->mt);
                                        $v4_valor = ControladorNotas::estado_nota_qualitativa($valor1->mt);
                                        ?>

                                        <td class="{{ $v4_estilo }}">
                                            @if ($valor1->mt == null)
                                                @php
                                                    $cadeiras_nulas++;
                                                @endphp
                                            --- @else
                                                {{ $v4_valor }} @endif
                                        </td>
                                        <?php
                                        }} ?>
                                        <!-- fim primiero trimestre-->

                                        <!-- segundo trimestre-->
                                        <?php if ($trimestre2->count() == 0) { ?>
                                        @php
                                            $cadeiras_nulas++;
                                        @endphp
                                        <td>---</td>
                                        <?php } else {foreach ($trimestre2 as $valor2) {

                                        $v4_estilo = ControladorNotas::nota_10Qualitativa($valor2->mt);
                                        $v4_valor = ControladorNotas::estado_nota_qualitativa($valor2->mt);
                                        ?>

                                        <td class="{{ $v4_estilo }}">
                                            @if ($valor2->mt == null)
                                                @php
                                                    $cadeiras_nulas++;
                                                @endphp
                                            --- @else
                                                {{ $v4_valor }} @endif
                                        </td>
                                        <?php
                                        }} ?>
                                        <!-- fim segundo trimestre-->

                                        <!-- terceiro trimestre-->
                                        <?php if ($trimestre3->count() == 0) { ?>
                                        @php
                                            $cadeiras_nulas++;
                                        @endphp
                                        <td>---</td>
                                        <?php } else {foreach ($trimestre3 as $valor3) {

                                        $v4_estilo = ControladorNotas::nota_10Qualitativa($valor3->mt);
                                        $v4_valor = ControladorNotas::estado_nota_qualitativa($valor3->mt);
                                        ?>

                                        <td class="{{ $v4_estilo }}">
                                            @if ($valor3->mt == null)
                                                @php
                                                    $cadeiras_nulas++;
                                                @endphp
                                            --- @else
                                                {{ $v4_valor }} @endif
                                        </td>
                                        <?php
                                        }} ?>
                                        <!-- fim terceiro trimestre-->

                                    @endif

                                    <?php foreach ($final as $valorf) {

                                    $v1_estilo = ControladorNotas::nota_10Qualitativa($valorf->mfd);
                                    if ($getCadeiraExame) {
                                    $v2_estilo = ControladorNotas::nota_10Qualitativa($valorf->npe);
                                    }
                                    $v3_estilo = ControladorNotas::nota_10Qualitativa($valorf->mf);
                                    if ($getCadeiraRecurso) {
                                    $v4_estilo = ControladorNotas::notaRec_5($valorf->rec);
                                    }

                                    $v1_valor = ControladorNotas::estado_nota_qualitativa($valorf->mfd);
                                    if ($getCadeiraExame) {
                                    $v2_valor = ControladorNotas::estado_nota_qualitativa($valorf->npe);
                                    }
                                    $v3_valor = ControladorNotas::estado_nota_qualitativa($valorf->mf);
                                    if ($getCadeiraRecurso) {
                                    $v4_valor = ControladorNotas::estado_nota_qualitativaRec($valorf->rec);
                                    }
                                    ?>
                                    @php
                                        $td2 = null;
                                        if (!$getCadeiraExame) {
                                            $td2 = 'td_color';
                                        }
                                    @endphp
                                    <td class="{{ $v3_estilo }}{{ $td2 }}">
                                        @if ($valorf->mf == null)
                                            @php
                                                $cadeiras_nulas++;
                                            @endphp
                                            ---
                                        @else {{ $v3_valor }} @endif
                                    </td>

                                    @if ($getCadeiraExame)

                                        <td class="{{ $v2_estilo }}">
                                            @if ($valorf->npe == null)
                                                @php
                                                    $cadeiras_nulas++;
                                                @endphp
                                                ---
                                            @else {{ $v2_valor }} @endif
                                        </td>
                                        <td class="{{ $v3_estilo }}td_color">
                                            @if ($valorf->mf == null)
                                                @php
                                                    $cadeiras_nulas++;
                                                @endphp
                                                ---
                                            @else {{ $v3_valor }} @endif
                                        </td>
                                    @endif

                                    @if ($getCadeiraRecurso)
                                        <td class="{{ $v4_estilo }}">
                                        @if ($valorf->rec == null) --- @else
                                                {{ $v4_valor }} @endif
                                        </td>
                                    @endif

                                    <?php
                                    }}
                                    } ?>
                                    <!-- obs -->
                                    @if ($historico->observacao_final)
                                        <td>{{ strtoupper($historico->observacao_final) }}</td>
                                    @else
                                        @if ($cadeiras_nulas >= 1)
                                            <td></td>
                                        @else
                                            @if ($historico->obs_pauta)
                                                @php
                                                    $td4 = null;
                                                    if ($historico->obs_pauta == 'Transita') {
                                                        $td4 = 'positivo';
                                                    } else {
                                                        $td4 = 'negativo';
                                                    }
                                                @endphp
                                                <td class="{{ $td4 }}">
                                                    {{ strtoupper($historico->obs_pauta) }}
                                                </td>
                                            @else
                                                <td>
                                                    ---
                                                </td>
                                            @endif
                                        @endif
                                    @endif


                                    <!-- fim obs-->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000"
                        style="width: 100%;">
                        <thead>

                            <tr>
                                <th rowspan="2">Nº</th>
                                <th rowspan="2">NOME COMPLETO</th>
                                <th rowspan="2">G</th>
                                <?php foreach ($getOrdenaDisciplinas as $disciplina) {

                                $numero_colspan = 2;
                                $getDisciplina = ControladorStatic::getDisciplinaID($disciplina->id_disciplina);
                                $getCadeiraExame = ControladorStatic::getExameStatus($getDirector->turma->id_curso,
                                $getDirector->turma->id_classe, $disciplina->id_disciplina);
                                $getCadeiraRecurso = ControladorStatic::getRecursoStatus($getDirector->turma->id_curso,
                                $getDirector->turma->id_classe, $disciplina->id_disciplina);

                                if ($getCadeiraExame) {
                                $numero_colspan = $numero_colspan + 1;
                                }

                                if (!$getCadeiraExame) {
                                $numero_colspan = 4;
                                }

                                if ($getCadeiraRecurso) {
                                $numero_colspan = $numero_colspan + 1;
                                }
                                ?>
                                <th colspan="{{ $numero_colspan }}">{{ strtoupper($getDisciplina->disciplina) }}
                                </th>
                                <?php
                                } ?>
                                <th rowspan="2">OBSERVAÇÃO</th>
                            </tr>
                            <tr>
                                @foreach ($getOrdenaDisciplinas as $disciplina)
                                    <?php
                                    $getCadeiraExame = ControladorStatic::getExameStatus($getDirector->turma->id_curso,
                                    $getDirector->turma->id_classe, $disciplina->id_disciplina);
                                    $getCadeiraRecurso =
                                    ControladorStatic::getRecursoStatus($getDirector->turma->id_curso,
                                    $getDirector->turma->id_classe, $disciplina->id_disciplina);
                                    ?>
                                    @if (!$getCadeiraExame)
                                        <th>MT1</th>
                                        <th>MT2</th>
                                        <th>MT3</th>
                                    @endif
                                    <th>MFD</th>
                                    @if ($getCadeiraExame)
                                        <th>NPE</th>
                                        <th>MF</th>
                                    @endif

                                    @if ($getCadeiraRecurso)
                                        <th>REC</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($getHistorico as $historico)
                                @php
                                    $cadeiras_nulas = 0;
                                @endphp

                                <tr class="{{ $historico->observacao_final }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $historico->estudante->pessoa->nome }}</td>
                                    <td>{{ $historico->estudante->pessoa->genero }}</td>

                                    <?php foreach ($getOrdenaDisciplinas as $disciplina) {
                                    $getCadeiraExame = ControladorStatic::getExameStatus($getDirector->turma->id_curso,
                                    $getDirector->turma->id_classe, $disciplina->id_disciplina);
                                    $getCadeiraRecurso =
                                    ControladorStatic::getRecursoStatus($getDirector->turma->id_curso,
                                    $getDirector->turma->id_classe, $disciplina->id_disciplina);
                                    $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante,
                                    $disciplina->id_disciplina, $getDirector->ano_lectivo);

                                    $trimestre1 =
                                    ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina->id_disciplina,
                                    $historico->id_estudante, 1, $getDirector->ano_lectivo);
                                    $trimestre2 =
                                    ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina->id_disciplina,
                                    $historico->id_estudante, 2, $getDirector->ano_lectivo);
                                    $trimestre3 =
                                    ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina->id_disciplina,
                                    $historico->id_estudante, 3, $getDirector->ano_lectivo);
                                    if ($final->count() == 0) { ?>
                                    @if (!$getCadeiraExame)
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    @endif

                                    @php
                                        $td1 = null;
                                        if (!$getCadeiraExame) {
                                            $td1 = 'td_color';
                                        }
                                    @endphp

                                    <td class="{{ $td1 }}">---</td>
                                    @if ($getCadeiraExame)
                                        <td>---</td>
                                        <td class="td_color">---</td>
                                    @endif

                                    @if ($getCadeiraRecurso)
                                        <td>---</td>
                                    @endif
                                    <?php } else { ?>

                                    @if (!$getCadeiraExame)

                                        <!-- primiero trimestre-->
                                        <?php if ($trimestre1->count() == 0) { ?>
                                        @php
                                            $cadeiras_nulas++;
                                        @endphp
                                        <td>---</td>
                                        <?php } else {foreach ($trimestre1 as $valor1) {

                                        $v4_estilo = ControladorNotas::nota_10Qualitativa($valor1->mt);
                                        $v4_valor = ControladorNotas::estado_nota_qualitativa($valor1->mt);
                                        ?>

                                        <td class="{{ $v4_estilo }}">
                                            @if ($valor1->mt == null)
                                                @php
                                                    $cadeiras_nulas++;
                                                @endphp
                                            --- @else
                                                {{ $v4_valor }} @endif
                                        </td>
                                        <?php
                                        }} ?>
                                        <!-- fim primiero trimestre-->

                                        <!-- segundo trimestre-->
                                        <?php if ($trimestre2->count() == 0) { ?>
                                        @php
                                            $cadeiras_nulas++;
                                        @endphp
                                        <td>---</td>
                                        <?php } else {foreach ($trimestre2 as $valor2) {

                                        $v4_estilo = ControladorNotas::nota_10Qualitativa($valor2->mt);
                                        $v4_valor = ControladorNotas::estado_nota_qualitativa($valor2->mt);
                                        ?>

                                        <td class="{{ $v4_estilo }}">
                                            @if ($valor2->mt == null)
                                                @php
                                                    $cadeiras_nulas++;
                                                @endphp
                                            --- @else
                                                {{ $v4_valor }} @endif
                                        </td>
                                        <?php
                                        }} ?>
                                        <!-- fim segundo trimestre-->

                                        <!-- terceiro trimestre-->
                                        <?php if ($trimestre3->count() == 0) { ?>
                                        @php
                                            $cadeiras_nulas++;
                                        @endphp
                                        <td>---</td>
                                        <?php } else {foreach ($trimestre3 as $valor3) {

                                        $v4_estilo = ControladorNotas::nota_10Qualitativa($valor3->mt);
                                        $v4_valor = ControladorNotas::estado_nota_qualitativa($valor3->mt);
                                        ?>

                                        <td class="{{ $v4_estilo }}">
                                            @if ($valor3->mt == null)
                                                @php
                                                    $cadeiras_nulas++;
                                                @endphp
                                            --- @else
                                                {{ $v4_valor }} @endif
                                        </td>
                                        <?php
                                        }} ?>
                                        <!-- fim terceiro trimestre-->

                                    @endif

                                    <?php foreach ($final as $valorf) {

                                    $v1_estilo = ControladorNotas::nota_10Qualitativa($valorf->mfd);
                                    if ($getCadeiraExame) {
                                    $v2_estilo = ControladorNotas::nota_10Qualitativa($valorf->npe);
                                    }
                                    $v3_estilo = ControladorNotas::nota_10Qualitativa($valorf->mf);
                                    if ($getCadeiraRecurso) {
                                    $v4_estilo = ControladorNotas::notaRec_5($valorf->rec);
                                    }

                                    $v1_valor = ControladorNotas::estado_nota_qualitativa($valorf->mfd);
                                    if ($getCadeiraExame) {
                                    $v2_valor = ControladorNotas::estado_nota_qualitativa($valorf->npe);
                                    }
                                    $v3_valor = ControladorNotas::estado_nota_qualitativa($valorf->mf);
                                    if ($getCadeiraRecurso) {
                                    $v4_valor = ControladorNotas::estado_nota_qualitativaRec($valorf->rec);
                                    }
                                    ?>

                                    @php
                                        $td2 = null;
                                        if (!$getCadeiraExame) {
                                            $td2 = 'td_color';
                                        }
                                    @endphp

                                    <td class="{{ $v1_estilo }}{{ $td2 }}">
                                        @if ($valorf->mfd == null)
                                            @php
                                                $cadeiras_nulas++;
                                            @endphp
                                            ---
                                        @else {{ $v1_valor }} @endif
                                    </td>

                                    @if ($getCadeiraExame)
                                        <td class="{{ $v2_estilo }}">
                                            @if ($valorf->npe == null)
                                                @php
                                                    $cadeiras_nulas++;
                                                @endphp
                                                ---
                                            @else {{ $v2_valor }} @endif
                                        </td>
                                        <td class="{{ $v3_estilo }}td_color">
                                            @if ($valorf->mf == null)
                                                @php
                                                    $cadeiras_nulas++;
                                                @endphp
                                                ---
                                            @else {{ $v3_valor }} @endif
                                        </td>
                                    @endif

                                    @if ($getCadeiraRecurso)
                                        <td class="{{ $v4_estilo }}">
                                        @if ($valorf->rec == null) --- @else
                                                {{ $v4_valor }} @endif
                                        </td>
                                    @endif

                                    <?php
                                    }}
                                    } ?>
                                    <!-- obs -->
                                    @if ($historico->observacao_final)
                                        <td>{{ strtoupper($historico->observacao_final) }}</td>
                                    @else
                                        @if ($cadeiras_nulas >= 1)
                                            <td></td>
                                        @else
                                            @if ($historico->obs_pauta)
                                                @php
                                                    $td4 = null;
                                                    if ($historico->obs_pauta == 'Transita') {
                                                        $td4 = 'positivo';
                                                    } else {
                                                        $td4 = 'negativo';
                                                    }
                                                @endphp

                                                <td class="{{ $td4 }}">
                                                    {{ strtoupper($historico->obs_pauta) }}
                                                </td>
                                            @else
                                                <td>
                                                    ---
                                                </td>
                                            @endif
                                        @endif
                                    @endif


                                    <!-- fim obs-->
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
                <div class="subdirector">
                    O(A) COOORDENADOR DE TURMA<br />
                    __________________________________<br />
                    // {{ $getDirector->funcionario->pessoa->nome }} //
                </div><br/><br/>


                <div class="director">
                    O(A) DIRECTOR(A)<br />
                    _____________________________<br />
                    // Aurélio Messele Tchissende //
                </div>
            </div>
        </div>
    </div>

</body>

</html>

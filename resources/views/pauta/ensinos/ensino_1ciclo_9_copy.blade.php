@php
use App\Http\Controllers\ControladorNotas;
use App\Http\Controllers\ControladorStatic;
@endphp
@extends('layouts.app')
@section('content')
    <?php
    $numero_colspan = 2;
    $getCadeiraExame = false;
    $getCadeiraRecurso = false;
    ?>
    <style>
        table thead {
            background-color: #4680ff;
            color: #fff;
        }

        table thead th {
            font-weight: normal;
        }

    </style>
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $submenu }}
                            <i class="ti-angle-right"></i>
                            {{ $getDirector->turma->turma }}
                            <i class="ti-angle-right"></i>
                            {{ $getDirector->turma->turno->turno }}
                            <i class="ti-angle-right"></i>
                            {{ $getDirector->turma->curso->curso }}
                            <i class="ti-angle-right"></i>
                            {{ $getDirector->ano_lectivo }}
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
                            <div class="col-lg-12 col-xl-12">
                                <div class="table-responsive tabela">
                                    @if (!$getOrdenaDisciplinas)
                                        <table class="table table-bordered ">
                                            <thead>

                                                <tr>
                                                    <th rowspan="2">Nº</th>
                                                    <th rowspan="2" style="width:47px;">FOTO</th>
                                                    <th rowspan="2">NOME COMPLETO</th>
                                                    <th rowspan="2">G</th>
                                                    <?php foreach (Session::get('disciplinas') as
                                                    $disciplina) {

                                                    $numero_colspan = 2;
                                                    $getDisciplina =
                                                    ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                                                    $getCadeiraExame =
                                                    ControladorStatic::getExameStatus($getDirector->turma->id_curso,
                                                    $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                                    $getCadeiraRecurso =
                                                    ControladorStatic::getRecursoStatus($getDirector->turma->id_curso,
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
                                                    <th colspan="{{ $numero_colspan }}">
                                                        {{ strtoupper($getDisciplina->disciplina) }}</th>
                                                    <?php
                                                    } ?>
                                                    <th rowspan="2">OBSERVAÇÃO</th>
                                                </tr>
                                                <tr>
                                                    @foreach (Session::get('disciplinas') as $disciplina)
                                                        <?php
                                                        $getCadeiraExame =
                                                        ControladorStatic::getExameStatus($getDirector->turma->id_curso,
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

                                                    <tr class="{{ $historico->observacao_final }}">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="
                                                                @if ($historico->estudante->pessoa->foto) {{ asset($historico->estudante->pessoa->foto) }}
                                                        @else
                                                            {{ asset('assets/template/images/profile.png') }} @endif
                                                            " alt="" style="width:47px; height:47px; border-radius:4px;">
                                                        </td>
                                                        <td>{{ $historico->estudante->pessoa->nome }}</td>
                                                        <td>{{ $historico->estudante->pessoa->genero }}</td>

                                                        <?php foreach (Session::get('disciplinas') as
                                                        $disciplina) {
                                                        $getCadeiraExame =
                                                        ControladorStatic::getExameStatus($getDirector->turma->id_curso,
                                                        $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                                        $getCadeiraRecurso =
                                                        ControladorStatic::getRecursoStatus($getDirector->turma->id_curso,
                                                        $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                                        $final =
                                                        ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante,
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
                                                        <td class="@if (!$getCadeiraExame) td_color @endif">---</td>
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
                                                            <td>---</td>
                                                            <?php } else {foreach ($trimestre1 as $valor1) {
                                                            $v4_estilo = ControladorNotas::nota_20($valor1->mt); ?>

                                                            <td class="{{ $v4_estilo }}">
                                                                @if ($valor1->mt == null)
                                                                    ---
                                                                @else {{ strtr(round($valor1->mt, 1), '.', ',') }}
                                                                @endif
                                                            </td>
                                                            <?php
                                                            }} ?>
                                                            <!-- fim primiero trimestre-->

                                                            <!-- segundo trimestre-->
                                                            <?php if ($trimestre2->count() == 0) { ?>
                                                            <td>---</td>
                                                            <?php } else {foreach ($trimestre2 as $valor2) {
                                                            $v4_estilo = ControladorNotas::nota_20($valor2->mt); ?>

                                                            <td class="{{ $v4_estilo }}">
                                                                @if ($valor2->mt == null)
                                                                    ---
                                                                @else {{ strtr(round($valor2->mt, 1), '.', ',') }}
                                                                @endif
                                                            </td>
                                                            <?php
                                                            }} ?>
                                                            <!-- fim segundo trimestre-->

                                                            <!-- terceiro trimestre-->
                                                            <?php if ($trimestre3->count() == 0) { ?>
                                                            <td>---</td>
                                                            <?php } else {foreach ($trimestre3 as $valor3) {
                                                            $v4_estilo = ControladorNotas::nota_20($valor3->mt); ?>

                                                            <td class="{{ $v4_estilo }}">
                                                                @if ($valor3->mt == null)
                                                                    ---
                                                                @else {{ strtr(round($valor3->mt, 1), '.', ',') }}
                                                                @endif
                                                            </td>
                                                            <?php
                                                            }} ?>
                                                            <!-- fim terceiro trimestre-->

                                                        @endif

                                                        <?php foreach ($final as $valorf) {

                                                        $v1_estilo = ControladorNotas::nota_20($valorf->mfd);
                                                        $v2_estilo = ControladorNotas::nota_20($valorf->npe);
                                                        $v3_estilo = ControladorNotas::nota_20($valorf->mf);
                                                        $v4_estilo = ControladorNotas::notaRec_10($valorf->rec);
                                                        ?>

                                                        @if (!$getCadeiraExame)
                                                            <td class="{{ $v1_estilo }} @if (!$getCadeiraExame) td_color @endif">
                                                                @if ($valorf->mf == null)
                                                                    ---
                                                                @else {{ $valorf->mf }} @endif
                                                            </td>
                                                        @endif

                                                        @if ($getCadeiraExame)
                                                            <td class="{{ $v1_estilo }} @if (!$getCadeiraExame) td_color @endif">
                                                                @if ($valorf->mfd == null)
                                                                    ---
                                                                @else {{ strtr(round($valorf->mfd, 1), '.', ',') }}
                                                                @endif
                                                            </td>
                                                            <td class="{{ $v2_estilo }}">
                                                                @if ($valorf->npe == null)
                                                                    ---
                                                                @else {{ strtr(round($valorf->npe, 1), '.', ',') }} @endif
                                                            </td>
                                                            <td class="{{ $v3_estilo }} td_color">
                                                                @if ($valorf->mf == null)
                                                                    ---
                                                                @else {{ $valorf->mf }} @endif
                                                            </td>
                                                        @endif

                                                        @if ($getCadeiraRecurso)
                                                            <td class="{{ $v4_estilo }}">
                                                                @if ($valorf->rec == null)
                                                                    ---
                                                                @else {{ $valorf->rec }} @endif
                                                            </td>
                                                        @endif

                                                        <?php
                                                        }}
                                                        } ?>
                                                        <!-- obs -->
                                                        @if ($historico->observacao_final)
                                                            <td>{{ strtoupper($historico->observacao_final) }}</td>
                                                        @else
                                                            @if ($historico->obs_pauta)
                                                                <td class="@if ($historico->obs_pauta
                                                                == 'Transita') positivo @else negativo @endif">
                                                                    {{ strtoupper($historico->obs_pauta) }}
                                                                </td>
                                                            @else
                                                                <td>
                                                                    ---
                                                                </td>
                                                            @endif
                                                        @endif


                                                        <!-- fim obs-->
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <table class="table table-bordered ">
                                            <thead>

                                                <tr>
                                                    <th rowspan="2">Nº</th>
                                                    <th rowspan="2" style="width:47px;">FOTO</th>
                                                    <th rowspan="2">NOME COMPLETO</th>
                                                    <th rowspan="2">G</th>
                                                    <?php foreach ($getOrdenaDisciplinas as $disciplina) {

                                                    $numero_colspan = 2;
                                                    $getDisciplina =
                                                    ControladorStatic::getDisciplinaID($disciplina->id_disciplina);
                                                    $getCadeiraExame =
                                                    ControladorStatic::getExameStatus($getDirector->turma->id_curso,
                                                    $getDirector->turma->id_classe, $disciplina->id_disciplina);
                                                    $getCadeiraRecurso =
                                                    ControladorStatic::getRecursoStatus($getDirector->turma->id_curso,
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
                                                    <th colspan="{{ $numero_colspan }}">
                                                        {{ strtoupper($getDisciplina->disciplina) }}</th>
                                                    <?php
                                                    } ?>
                                                    <th rowspan="2">OBSERVAÇÃO</th>
                                                </tr>
                                                <tr>
                                                    @foreach ($getOrdenaDisciplinas as $disciplina)
                                                        <?php
                                                        $getCadeiraExame =
                                                        ControladorStatic::getExameStatus($getDirector->turma->id_curso,
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

                                                    <tr class="{{ $historico->observacao_final }}">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="
                                                                @if ($historico->estudante->pessoa->foto) {{ asset($historico->estudante->pessoa->foto) }}
                                                        @else
                                                            {{ asset('assets/template/images/profile.png') }} @endif
                                                            " alt="" style="width:47px; height:47px; border-radius:4px;">
                                                        </td>
                                                        <td>{{ $historico->estudante->pessoa->nome }}</td>
                                                        <td>{{ $historico->estudante->pessoa->genero }}</td>

                                                        <?php foreach ($getOrdenaDisciplinas as $disciplina)
                                                        {
                                                        $getCadeiraExame =
                                                        ControladorStatic::getExameStatus($getDirector->turma->id_curso,
                                                        $getDirector->turma->id_classe, $disciplina->id_disciplina);
                                                        $getCadeiraRecurso =
                                                        ControladorStatic::getRecursoStatus($getDirector->turma->id_curso,
                                                        $getDirector->turma->id_classe, $disciplina->id_disciplina);
                                                        $final =
                                                        ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante,
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
                                                        <td class="@if (!$getCadeiraExame) td_color @endif">---</td>
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
                                                            <td>---</td>
                                                            <?php } else {foreach ($trimestre1 as $valor1) {
                                                            $v4_estilo = ControladorNotas::nota_20($valor1->mt); ?>

                                                            <td class="{{ $v4_estilo }}">
                                                                @if ($valor1->mt == null)
                                                                    ---
                                                                @else {{ strtr(round($valor1->mt, 1), '.', ',') }}
                                                                @endif
                                                            </td>
                                                            <?php
                                                            }} ?>
                                                            <!-- fim primiero trimestre-->

                                                            <!-- segundo trimestre-->
                                                            <?php if ($trimestre2->count() == 0) { ?>
                                                            <td>---</td>
                                                            <?php } else {foreach ($trimestre2 as $valor2) {
                                                            $v4_estilo = ControladorNotas::nota_20($valor2->mt); ?>

                                                            <td class="{{ $v4_estilo }}">
                                                                @if ($valor2->mt == null)
                                                                    ---
                                                                @else {{ strtr(round($valor2->mt, 1), '.', ',') }}
                                                                @endif
                                                            </td>
                                                            <?php
                                                            }} ?>
                                                            <!-- fim segundo trimestre-->

                                                            <!-- terceiro trimestre-->
                                                            <?php if ($trimestre3->count() == 0) { ?>
                                                            <td>---</td>
                                                            <?php } else {foreach ($trimestre3 as $valor3) {
                                                            $v4_estilo = ControladorNotas::nota_20($valor3->mt); ?>

                                                            <td class="{{ $v4_estilo }}">
                                                                @if ($valor3->mt == null)
                                                                    ---
                                                                @else {{ strtr(round($valor3->mt, 1), '.', ',') }}
                                                                @endif
                                                            </td>
                                                            <?php
                                                            }} ?>
                                                            <!-- fim terceiro trimestre-->

                                                        @endif

                                                        <?php foreach ($final as $valorf) {

                                                        $v1_estilo = ControladorNotas::nota_20($valorf->mfd);
                                                        $v2_estilo = ControladorNotas::nota_20($valorf->npe);
                                                        $v3_estilo = ControladorNotas::nota_20($valorf->mf);
                                                        $v4_estilo = ControladorNotas::notaRec_10($valorf->rec);
                                                        ?>

                                                        @if (!$getCadeiraExame)
                                                            <td class="{{ $v1_estilo }} @if (!$getCadeiraExame) td_color @endif">
                                                                @if ($valorf->mf == null)
                                                                    ---
                                                                @else {{ $valorf->mf }} @endif
                                                            </td>
                                                        @endif

                                                        @if ($getCadeiraExame)
                                                            <td class="{{ $v1_estilo }} @if (!$getCadeiraExame) td_color @endif">
                                                                @if ($valorf->mfd == null)
                                                                    ---
                                                                @else {{ strtr(round($valorf->mfd, 1), '.', ',') }}
                                                                @endif
                                                            </td>
                                                            <td class="{{ $v2_estilo }}">
                                                                @if ($valorf->npe == null)
                                                                    ---
                                                                @else {{ strtr(round($valorf->npe, 1), '.', ',') }}
                                                                @endif
                                                            </td>
                                                            <td class="{{ $v3_estilo }} td_color">
                                                                @if ($valorf->mf == null)
                                                                    ---
                                                                @else {{ $valorf->mf }} @endif
                                                            </td>
                                                        @endif

                                                        @if ($getCadeiraRecurso)
                                                            <td class="{{ $v4_estilo }}">
                                                                @if ($valorf->rec == null)
                                                                    ---
                                                                @else {{ $valorf->rec }} @endif
                                                            </td>
                                                        @endif

                                                        <?php
                                                        }}
                                                        } ?>
                                                        <!-- obs -->
                                                        @if ($historico->observacao_final)
                                                            <td>{{ strtoupper($historico->observacao_final) }}</td>
                                                        @else
                                                            @if ($historico->obs_pauta)
                                                                <td class="@if ($historico->obs_pauta
                                                                == 'Transita') positivo @else negativo @endif">
                                                                    {{ strtoupper($historico->obs_pauta) }}
                                                                </td>
                                                            @else
                                                                <td>
                                                                    ---
                                                                </td>
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
            <a href="/pautas/create/{{ $getDirector->id_turma }}/{{ $getDirector->ano_lectivo }}" type="button"
                class="btn btn-primary btnCircular btnPrincipal" title="Voltar"><i class="ti-arrow-left"></i></a>
        </div>
    </div>

@endsection

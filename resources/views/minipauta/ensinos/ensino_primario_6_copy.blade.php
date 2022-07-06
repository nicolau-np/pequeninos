@php
use App\Http\Controllers\ControladorNotas;
use App\Http\Controllers\ControladorStatic;
$numero_colspan = 2;
if ($getCadeiraRecurso) {
    $numero_colspan = $numero_colspan + 1;
}

if ($getCadeiraExame) {
    if ($getCadeiraExame->exame_oral == 'sim') {
        $numero_colspan = $numero_colspan + 3;
    } else {
        $numero_colspan = $numero_colspan + 1;
    }
}
@endphp
@extends('layouts.app')
@section('content')
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
                            {{ $getHorario->turma->turma }}
                            <i class="ti-angle-right"></i>
                            {{ $getHorario->turma->turno->turno }}
                            <i class="ti-angle-right"></i>
                            {{ $getHorario->turma->curso->curso }}
                            <i class="ti-angle-right"></i>
                            {{ $getHorario->disciplina->disciplina }}
                            <i class="ti-angle-right"></i>
                            {{ $getHorario->ano_lectivo }}
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
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Nº</th>
                                                <th rowspan="2" style="width:47px;">FOTO</th>
                                                <th rowspan="2">NOME COMPLETO</th>
                                                <th rowspan="2">G</th>
                                                <th colspan="4">1º TRIMESTRE</th>
                                                <th colspan="4">2º TRIMESTRE</th>
                                                <th colspan="4">3º TRIMESTRE</th>
                                                <th colspan="{{ $numero_colspan }}">DADOS FINAIS</th>
                                                <th rowspan="2">OBS.</th>
                                            </tr>
                                            <tr>
                                                <th>MAC1</th>
                                                <th>NPP1</th>
                                                <th>PT1</th>
                                                <th>MT1</th>

                                                <th>MAC2</th>
                                                <th>NPP2</th>
                                                <th>PT2</th>
                                                <th>MT2</th>

                                                <th>MAC3</th>
                                                <th>NPP3</th>
                                                <th>PT3</th>
                                                <th>MT3</th>

                                                <th>MFD</th>
                                                @if ($getCadeiraExame)
                                                    @if ($getCadeiraExame->exame_oral == 'sim')
                                                        <th>NEE</th>
                                                        <th>NEO</th>
                                                    @endif
                                                    <th>MEC</th>
                                                @endif
                                                <th>MF</th>
                                                @if ($getCadeiraRecurso)
                                                    <th>REC</th>
                                                @endif
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

                                                    <!-- primeiro trimestre-->
                                                    <?php
                                                    $restricao1 = ControladorStatic::getRestricao(1,
                                                    $getHorario->ano_lectivo, $historico->id_estudante);
                                                    $trimestre1 =
                                                    ControladorNotas::getValoresMiniPautaTrimestralPDF($getHorario->id_disciplina,
                                                    $historico->id_estudante, 1, $getHorario->ano_lectivo);
                                                    if ($restricao1) { ?>
                                                    <td colspan="4">DÍVIDAS POR PAGAR</td>
                                                    <?php } else {if ($trimestre1->count() == 0) { ?>
                                                    <td>---</td>
                                                    <td>---</td>
                                                    <td>---</td>
                                                    <td class="td_color">---</td>
                                                    <?php } else {foreach ($trimestre1 as $valor1) {

                                                    $v1_estilo = ControladorNotas::nota_10(round($valor1->mac, 1));
                                                    $v2_estilo = ControladorNotas::nota_10(round($valor1->npp, 1));
                                                    $v3_estilo = ControladorNotas::nota_10(round($valor1->pt, 1));
                                                    $v4_estilo = ControladorNotas::nota_10(round($valor1->mt, 1));
                                                    ?>

                                                    <td class="{{ $v1_estilo }}">
                                                        @if ($valor1->mac == null) ---
                                                        @else {{ strtr(round($valor1->mac, 1), '.', ',') }}
                                                        @endif
                                                    </td>
                                                    <td class="{{ $v2_estilo }}">
                                                        @if ($valor1->npp == null) ---
                                                        @else {{ strtr(round($valor1->npp, 1), '.', ',') }}
                                                        @endif
                                                    </td>
                                                    <td class="{{ $v3_estilo }}">
                                                    @if ($valor1->pt == null) --- @else
                                                            {{ strtr(round($valor1->pt, 1), '.', ',') }} @endif
                                                    </td>
                                                    <td class="{{ $v4_estilo }} td_color">
                                                    @if ($valor1->mt == null) --- @else
                                                            {{ strtr(round($valor1->mt, 1), '.', ',') }} @endif
                                                    </td>
                                                    <?php
                                                    }}}
                                                    ?>
                                                    <!-- fim primeiro trimestre-->

                                                    <!-- segundo trimestre-->
                                                    <?php
                                                    $restricao2 = ControladorStatic::getRestricao(2,
                                                    $getHorario->ano_lectivo, $historico->id_estudante);
                                                    $trimestre2 =
                                                    ControladorNotas::getValoresMiniPautaTrimestralPDF($getHorario->id_disciplina,
                                                    $historico->id_estudante, 2, $getHorario->ano_lectivo);
                                                    if ($restricao2) { ?>
                                                    <td colspan="4">DÍVIDAS POR PAGAR</td>
                                                    <?php } else {if ($trimestre2->count() == 0) { ?>
                                                    <td>---</td>
                                                    <td>---</td>
                                                    <td>---</td>
                                                    <td class="td_color">---</td>
                                                    <?php } else {foreach ($trimestre2 as $valor2) {

                                                    $v1_estilo = ControladorNotas::nota_10(round($valor2->mac, 1));
                                                    $v2_estilo = ControladorNotas::nota_10(round($valor2->npp, 1));
                                                    $v3_estilo = ControladorNotas::nota_10(round($valor2->pt, 1));
                                                    $v4_estilo = ControladorNotas::nota_10(round($valor2->mt, 1));
                                                    ?>

                                                    <td class="{{ $v1_estilo }}">
                                                        @if ($valor2->mac == null) ---
                                                        @else {{ strtr(round($valor2->mac, 1), '.', ',') }}
                                                        @endif
                                                    </td>
                                                    <td class="{{ $v2_estilo }}">
                                                        @if ($valor2->npp == null) ---
                                                        @else {{ strtr(round($valor2->npp, 1), '.', ',') }}
                                                        @endif
                                                    </td>
                                                    <td class="{{ $v3_estilo }}">
                                                    @if ($valor2->pt == null) --- @else
                                                            {{ strtr(round($valor2->pt, 1), '.', ',') }} @endif
                                                    </td>
                                                    <td class="{{ $v4_estilo }} td_color">
                                                    @if ($valor2->mt == null) --- @else
                                                            {{ strtr(round($valor2->mt, 1), '.', ',') }} @endif
                                                    </td>
                                                    <?php
                                                    }}}
                                                    ?>
                                                    <!-- fim segundo trimestre-->

                                                    <!-- terceiro trimestre-->
                                                    <?php
                                                    $restricao3 = ControladorStatic::getRestricao(3,
                                                    $getHorario->ano_lectivo, $historico->id_estudante);
                                                    $trimestre3 =
                                                    ControladorNotas::getValoresMiniPautaTrimestralPDF($getHorario->id_disciplina,
                                                    $historico->id_estudante, 3, $getHorario->ano_lectivo);
                                                    if ($restricao3) { ?>
                                                    <td colspan="4">DÍVIDAS POR PAGAR</td>
                                                    <?php } else {if ($trimestre3->count() == 0) { ?>
                                                    <td>---</td>
                                                    <td>---</td>
                                                    <td>---</td>
                                                    <td class="td_color">---</td>
                                                    <?php } else {foreach ($trimestre3 as $valor3) {

                                                    $v1_estilo = ControladorNotas::nota_10(round($valor3->mac, 1));
                                                    $v2_estilo = ControladorNotas::nota_10(round($valor3->npp, 1));
                                                    $v3_estilo = ControladorNotas::nota_10(round($valor3->pt, 1));
                                                    $v4_estilo = ControladorNotas::nota_10(round($valor3->mt, 1));
                                                    ?>

                                                    <td class="{{ $v1_estilo }}">
                                                        @if ($valor3->mac == null) ---
                                                        @else {{ strtr(round($valor3->mac, 1), '.', ',') }}
                                                        @endif
                                                    </td>
                                                    <td class="{{ $v2_estilo }}">
                                                        @if ($valor3->npp == null) ---
                                                        @else {{ strtr(round($valor3->npp, 1), '.', ',') }}
                                                        @endif
                                                    </td>
                                                    <td class="{{ $v3_estilo }}">
                                                    @if ($valor3->pt == null) --- @else
                                                            {{ strtr(round($valor3->pt, 1), '.', ',') }} @endif
                                                    </td>
                                                    <td class="{{ $v4_estilo }} td_color">
                                                    @if ($valor3->mt == null) --- @else
                                                            {{ strtr(round($valor3->mt, 1), '.', ',') }} @endif
                                                    </td>
                                                    <?php
                                                    }}}
                                                    ?>
                                                    <!-- fim terceiro trimestre-->

                                                    <!-- dados finais-->
                                                    <?php
                                                    $final =
                                                    ControladorNotas::getValoresMiniPautaFinalPDF($getHorario->ano_lectivo,
                                                    $getHorario->id_disciplina, $historico->id_estudante);
                                                    if ($final->count() == 0) { ?>
                                                    <td>---</td>
                                                    @if ($getCadeiraExame)
                                                        <td>---</td>
                                                    @endif
                                                    <td>---</td>
                                                    @if ($getCadeiraRecurso)
                                                        <td>---</td>
                                                    @endif
                                                    <?php } else {foreach ($final as $valorf) {

                                                    $v1_estilo = ControladorNotas::nota_10(round($valorf->mfd, 1));
                                                    if ($getCadeiraExame) {
                                                    $v2_estilo = ControladorNotas::nota_10(round($valorf->npe, 1));
                                                    if ($getCadeiraExame->exame_oral == 'sim') {
                                                    $v02_estilo = ControladorNotas::nota_10(round($valorf->nee, 1));
                                                    $v002_estilo = ControladorNotas::nota_10(round($valorf->neo, 1));
                                                    }
                                                    }
                                                    $v3_estilo = ControladorNotas::nota_10($valorf->mf);
                                                    if ($getCadeiraRecurso) {
                                                    $v4_estilo = ControladorNotas::notaRec_5($valorf->rec);
                                                    }
                                                    ?>
                                                    <td class="{{ $v1_estilo }}">
                                                        @if ($valorf->mfd == null) ---
                                                        @else {{ strtr(round($valorf->mfd, 1), '.', ',') }}
                                                        @endif
                                                    </td>
                                                    @if ($getCadeiraExame)
                                                        @if ($getCadeiraExame->exame_oral == 'sim')
                                                            <td class="{{ $v02_estilo }}">
                                                                @if ($valorf->nee == null)
                                                                    ---
                                                                @else {{ strtr(round($valorf->nee, 1), '.', ',') }}
                                                                @endif
                                                            </td>
                                                            <td class="{{ $v002_estilo }}">
                                                                @if ($valorf->neo == null)
                                                                    ---
                                                                @else {{ strtr(round($valorf->neo, 1), '.', ',') }}
                                                                @endif
                                                            </td>
                                                        @endif
                                                        <td class="{{ $v2_estilo }}">
                                                            @if ($valorf->npe == null) ---
                                                            @else {{ strtr(round($valorf->npe, 1), '.', ',') }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                    <td class="{{ $v3_estilo }} td_color">
                                                    @if ($valorf->mf == null) --- @else
                                                            {{ $valorf->mf }} @endif
                                                    </td>
                                                    @if ($getCadeiraRecurso)
                                                        <td class="{{ $v4_estilo }}">
                                                            @if ($valorf->rec == null) ---
                                                            @else {{ $valorf->rec }} @endif
                                                        </td>
                                                    @endif
                                                    <?php
                                                    }}
                                                    ?>
                                                    <!-- fim dados finais-->

                                                    <!-- obs -->
                                                    @if ($final->count() == 0)
                                                        <td>---</td>
                                                    @else
                                                        @if ($valorf->mf == null)
                                                            <td>---</td>
                                                        @else
                                                            @if ($getCadeiraRecurso)
                                                                @if ($valorf->rec == null && $valorf->mf <= 4.99 && $valorf->mf != null)
                                                                    <td class="negativo">NÃO TRANSITA</td>
                                                                @else
                                                                    <td class="@if ($valorf->rec <=
                                                                        2.99 && $valorf->rec != null) negativo @else positivo @endif">
                                                                            @if ($valorf->rec <= 2.99 && $valorf->rec != null)
                                                                            NÃO TRANSITA @else TRANSITA @endif
                                                                    </td>
                                                                @endif

                                                            @else
                                                                <td class="@if ($valorf->mf <= 4.99 &&
                                                                    $valorf->mf != null) negativo @else
                                                                        positivo @endif">
                                                                        @if ($valorf->mf <= 4.99 && $valorf->mf != null)
                                                                        NÃO TRANSITA @else TRANSITA @endif
                                                                </td>
                                                            @endif

                                                        @endif

                                                    @endif
                                                    <!-- fim obs -->
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
            <a href="/cadernetas/list/{{ $getHorario->ano_lectivo }}" class="btn btn-primary btnCircular btnPrincipal"
                title="Voltar"><i class="ti-arrow-left"></i></a>
        </div>
    </div>

@endsection

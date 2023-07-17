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

                                $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                             
                                ?>
                                <th colspan="5">{{ strtoupper($getDisciplina->disciplina) }}
                                </th>
                                 <?php
                                } ?>
                                
                            </tr>
                            <tr>
                                @foreach (Session::get('disciplinas') as $disciplina)
                                    
                                    <th>MS1</th>
                                    <th>MS2</th>
                                    <th>MFD</th>
                                    <th>EX</th>
                                    <th>MF</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($getHistorico as $historico)
                                

                                <tr class="">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $historico->estudante->pessoa->nome }}</td>
                                    <td>{{ $historico->estudante->pessoa->genero }}</td>

                                    <?php foreach (Session::get('disciplinas') as $disciplina)
                                     {?>
                                    
                                    <?php } ?>      
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

                               
                                $getDisciplina = ControladorStatic::getDisciplinaID($disciplina->id_disciplina);
                               
                                ?>
                                <th colspan="5">{{ strtoupper($getDisciplina->disciplina) }}
                                </th>
                                <?php
                                } ?>
                                
                            </tr>
                            <tr>
                                @foreach ($getOrdenaDisciplinas as $disciplina)
                                     <th>MS1</th>
                                    <th>MS2</th>
                                    <th>MFD</th>
                                    <th>EX</th>
                                    <th>MF</th>
                                   
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($getHistorico as $historico)
                            

                                <tr class="{{ $historico->observacao_final }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $historico->estudante->pessoa->nome }}</td>
                                    <td>{{ $historico->estudante->pessoa->genero }}</td>

                                    <?php foreach ($getOrdenaDisciplinas as $disciplina) {

                            $modulo_final = ControladorNotas::getPautaModulo($historico->id_estudante,
                                    $disciplina->id_disciplina, $getDirector->ano_lectivo);

                            $mfd = 0;
                            $mf = 0;
                            $v1_estilo = null;
                            $v2_estilo = null;
                            $v3_estilo = null;
                            $v4_estilo = null;
                            $v5_estilo = null;
                                    if($modulo_final){
                                        if($modulo_final->ms1){
                                            $v1_estilo = ControladorNotas::nota_10($modulo_final->ms1);
                                        }
                                        if($modulo_final->ms2){
                                            $v2_estilo = ControladorNotas::nota_10($modulo_final->ms2);
                                        }

                                       if($modulo_final->ms1 && $modulo_final->ms2){
                                            $mfd = ($modulo_final->ms1 + $modulo_final->ms2)/2;
                                            $v3_estilo = ControladorNotas::nota_10($mfd);
                                        }

                                        if($modulo_final->exame){
                                            $v4_estilo = ControladorNotas::nota_10($modulo_final->exame);
                                        }

                                        if($modulo_final->exame){
                                            $mf = intval(round(($mfd*0.4 + $modulo_final->exame*0.6)));
                                            $v5_estilo = ControladorNotas::nota_10($mf);
                                        }
                                   
                                    }
                                        ?>
                                        <td class="{{$v1_estilo}}">
                                            @if($modulo_final)
                                            {{strtr(round($modulo_final->ms1, 1), '.', ',')}}
                                            @endif
                                        </td>
                                        <td class="{{$v2_estilo}}">
                                            @if($modulo_final)
                                            {{strtr(round($modulo_final->ms2, 1), '.', ',')}}
                                            @endif
                                        </td>
                                        <td class="{{$v3_estilo}}">
                                           @if($modulo_final)
                                            {{strtr(round($mfd, 1), '.', ',')}}
                                            @endif
                                        </td>
                                        <td class="{{$v4_estilo}}">
                                            @if($modulo_final)
                                            {{strtr(round($modulo_final->exame, 1), '.', ',')}}
                                            @endif
                                        </td>
                                        <td class="{{$v5_estilo}}">
                                            @if($modulo_final)
                                            {{$mf}}
                                            @endif
                                        </td>
                                    <?php }?>
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
                </div><br /><br />


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

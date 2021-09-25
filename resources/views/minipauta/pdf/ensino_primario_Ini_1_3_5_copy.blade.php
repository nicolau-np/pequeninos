@php
use App\Http\Controllers\ControladorNotas;
use App\Http\Controllers\ControladorStatic;

$count_avaliados1 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_avaliados2 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_avaliados3 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_avaliadosf = [
    'mfd'=>0,
    'npe'=>0,
    'mf'=>0,
];

$count_positivas1 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_positivas2 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_positivas3 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_positivasf = [
    'mfd'=>0,
    'npe'=>0,
    'mf'=>0,
];

$percent_positivas1 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$percent_positivas2 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$percent_positivas3 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$percent_positivasf = [
    'mfd'=>0,
    'npe'=>0,
    'mf'=>0,
];

$count_negativas1 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_negativas2 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_negativas3 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_negativasf = [
    'mfd'=>0,
    'npe'=>0,
    'mf'=>0,
];

$percent_negativas1 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$percent_negativas2 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$percent_negativas3 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$percent_negativasf = [
    'mfd'=>0,
    'npe'=>0,
    'mf'=>0,
];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>MINI-PAUTA {{$getHorario->ano_lectivo}} [{{strtoupper($getHorario->turma->turma)}}-{{strtoupper($getHorario->turma->turno->turno)}}-{{strtoupper($getHorario->turma->curso->curso)}}-{{strtoupper($getHorario->disciplina->disciplina)}} ]</title>
<style>
    .page-break{
        page-break-before: always;
    }

    @page{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 9px;
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .mini-cabecalho{
        display: block;
    }
    .ano_curso{
        float: left;
    }
    .periodo{
        float: right;
    }

    .positivo{
        color: #4680ff;
    }
    .negativo{
        color: red;
    }
    .neutro{
        color: #FFB64D;
    }
    .nenhum{
        color: #333;
    }
    table thead{
            background-color: #4680ff;
            color: #fff;
    }
    .tabela{
        font-size: 9px;
    }
    .teacher_name{
        text-align: center;
    }
</style>
</head>
<body>

<!-- primeira pagina -->
    <div class="default-page">

        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold;">MINI-PAUTA DE AVALIAÇÃO ANUAL</p>
         </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                &nbsp;&nbsp;{{$getHorario->ano_lectivo}} - [ {{strtoupper($getHorario->turma->turma)}} - {{strtoupper($getHorario->turma->curso->curso)}} ] - DISCIPLINA: {{strtoupper($getHorario->disciplina->disciplina)}}
            </div>
            <div class="periodo">
                PERÍODO: {{strtoupper($getHorario->turma->turno->turno)}}
                &nbsp;&nbsp;
                <br/>

            </div>
         </div>
         <br/>
         <div class="corpo">
            <div class="table-responsive">
                <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                    <thead>
                        <tr>
                            <th rowspan="2">Nº</th>
                            <th rowspan="2" width="140px;">NOME COMPLETO</th>
                            <th rowspan="2">G</th>
                            <th colspan="4">1º TRIMESTRE</th>
                            <th colspan="4">2º TRIMESTRE</th>
                            <th colspan="4">3º TRIMESTRE</th>
                            <th colspan="2">DADOS FINAIS</th>
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
                            <th>MF</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($getHistorico as $historico)
                      <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$historico->estudante->pessoa->nome}}</td>
                          <td>{{$historico->estudante->pessoa->genero}}</td>

                          <!-- primeiro trimestre-->
                          <?php
                              $trimestre1 = ControladorNotas::getValoresMiniPautaTrimestralPDF($getHorario->id_disciplina, $historico->id_estudante, 1, $getHorario->ano_lectivo);
                              if($trimestre1->count()==0){
                          ?>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                              <?php }
                              else{
                                  foreach($trimestre1 as $valor1){
                                      $v1_estilo = ControladorNotas::nota_10Qualitativa($valor1->mac);
                                      $v2_estilo = ControladorNotas::nota_10Qualitativa($valor1->npp);
                                      $v3_estilo = ControladorNotas::nota_10Qualitativa($valor1->pt);
                                      $v4_estilo = ControladorNotas::nota_10Qualitativa($valor1->mt);

                                      $v1_valor = ControladorNotas::estado_nota_qualitativa($valor1->mac);
                                      $v2_valor = ControladorNotas::estado_nota_qualitativa($valor1->npp);
                                      $v3_valor = ControladorNotas::estado_nota_qualitativa($valor1->pt);
                                      $v4_valor = ControladorNotas::estado_nota_qualitativa($valor1->mt);
                                  ?>

                                      <td class="{{$v1_estilo}}">@if($valor1->mac==null) --- @else {{$v1_valor}} @endif</td>
                                      <td class="{{$v2_estilo}}">@if($valor1->npp==null) --- @else {{$v2_valor}} @endif</td>
                                      <td class="{{$v3_estilo}}">@if($valor1->pt==null) --- @else {{$v3_valor}} @endif</td>
                                      <td class="{{$v4_estilo}}">@if($valor1->mt==null) --- @else {{$v4_valor}} @endif</td>
                                  <?php }}?>
                          <!-- fim primeiro trimestre-->

                          <!-- segundo trimestre-->
                          <?php
                              $trimestre2 = ControladorNotas::getValoresMiniPautaTrimestralPDF($getHorario->id_disciplina, $historico->id_estudante, 2, $getHorario->ano_lectivo);
                              if($trimestre2->count()==0){
                          ?>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                              <?php }
                              else{
                                  foreach($trimestre2 as $valor2){
                                      $v1_estilo = ControladorNotas::nota_10Qualitativa($valor2->mac);
                                      $v2_estilo = ControladorNotas::nota_10Qualitativa($valor2->npp);
                                      $v3_estilo = ControladorNotas::nota_10Qualitativa($valor2->pt);
                                      $v4_estilo = ControladorNotas::nota_10Qualitativa($valor2->mt);

                                      $v1_valor = ControladorNotas::estado_nota_qualitativa($valor2->mac);
                                      $v2_valor = ControladorNotas::estado_nota_qualitativa($valor2->npp);
                                      $v3_valor = ControladorNotas::estado_nota_qualitativa($valor2->pt);
                                      $v4_valor = ControladorNotas::estado_nota_qualitativa($valor2->mt);
                                  ?>

                                      <td class="{{$v1_estilo}}">@if($valor2->mac==null) --- @else {{$v1_valor}} @endif</td>
                                      <td class="{{$v2_estilo}}">@if($valor2->npp==null) --- @else {{$v2_valor}} @endif</td>
                                      <td class="{{$v3_estilo}}">@if($valor2->pt==null) --- @else {{$v3_valor}} @endif</td>
                                      <td class="{{$v4_estilo}}">@if($valor2->mt==null) --- @else {{$v4_valor}} @endif</td>
                                  <?php }}?>
                          <!-- fim segundo trimestre-->

                           <!-- terceiro trimestre-->
                           <?php
                           $trimestre3 = ControladorNotas::getValoresMiniPautaTrimestralPDF($getHorario->id_disciplina, $historico->id_estudante, 3, $getHorario->ano_lectivo);
                           if($trimestre3->count()==0){
                       ?>
                       <td>---</td>
                       <td>---</td>
                       <td>---</td>
                       <td>---</td>
                           <?php }
                           else{
                               foreach($trimestre3 as $valor3){
                                   $v1_estilo = ControladorNotas::nota_10Qualitativa($valor3->mac);
                                   $v2_estilo = ControladorNotas::nota_10Qualitativa($valor3->npp);
                                   $v3_estilo = ControladorNotas::nota_10Qualitativa($valor3->pt);
                                   $v4_estilo = ControladorNotas::nota_10Qualitativa($valor3->mt);

                                   $v1_valor = ControladorNotas::estado_nota_qualitativa($valor3->mac);
                                   $v2_valor = ControladorNotas::estado_nota_qualitativa($valor3->npp);
                                   $v3_valor = ControladorNotas::estado_nota_qualitativa($valor3->pt);
                                   $v4_valor = ControladorNotas::estado_nota_qualitativa($valor3->mt);
                               ?>

                       <td class="{{$v1_estilo}}">@if($valor3->mac==null) --- @else {{$v1_valor}} @endif</td>
                       <td class="{{$v2_estilo}}">@if($valor3->npp==null) --- @else {{$v2_valor}} @endif</td>
                       <td class="{{$v3_estilo}}">@if($valor3->pt==null) --- @else {{$v3_valor}} @endif</td>
                       <td class="{{$v4_estilo}}">@if($valor3->mt==null) --- @else {{$v4_valor}} @endif</td>
                               <?php }}?>
                       <!-- fim terceiro trimestre-->

                       <!-- dados finais-->
                       <?php
                          $final = ControladorNotas::getValoresMiniPautaFinalPDF($getHorario->ano_lectivo, $getHorario->id_disciplina, $historico->id_estudante);
                          if($final->count() == 0){
                       ?>
                          <td>---</td>
                          <td>---</td>
                      <?php }
                          else{
                              foreach ($final as $valorf){
                              $v1_estilo = ControladorNotas::nota_10Qualitativa($valorf->mfd);
                              $v2_estilo = ControladorNotas::nota_10Qualitativa($valorf->mf);

                              $v1_valor = ControladorNotas::estado_nota_qualitativa($valorf->mfd);
                              $v2_valor = ControladorNotas::estado_nota_qualitativa($valorf->mf);
                      ?>
                          <td class="{{$v1_estilo}}">@if($valorf->mfd==null) --- @else {{$v1_valor}} @endif</td>
                          <td class="{{$v2_estilo}}">@if($valorf->mf==null) --- @else {{$v2_valor}} @endif</td>
                      <?php }}?>
                      <!-- fim dados finais-->

                      </tr>
                      @endforeach
                    </tbody>
                 </table>
            </div>
        </div>
         <br/><br/>
         <div class="rodape">
            <div class="teacher_name">
                O(A) PROFESSOR(A)<br/>
                _____________________<br/>
                //{{$getHorario->funcionario->pessoa->nome}}//
            </div>
         </div>

    </div>
<!-- end primeira pagina -->

<!-- estatistica pagina -->
    <div class="page-break">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold;">MINI-PAUTA INFORMAÇÃO ESTATÍSTICA</p>
         </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                &nbsp;&nbsp;{{$getHorario->ano_lectivo}} - [ {{strtoupper($getHorario->turma->turma)}} - {{strtoupper($getHorario->turma->curso->curso)}} ] - DISCIPLINA: {{strtoupper($getHorario->disciplina->disciplina)}}
            </div>
            <div class="periodo">
                PERÍODO: {{strtoupper($getHorario->turma->turno->turno)}}
                &nbsp;&nbsp;
                <br/>
        </div>
         </div>
         <br/>
         <div class="corpo">

            <div class="table-responsive tabela">
                <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                    <thead>
                        <tr>
                            <th rowspan="2">-</th>
                            <th colspan="4">1º TRIMESTRE</th>
                            <th colspan="4">2º TRIMESTRE</th>
                            <th colspan="4">3º TRIMESTRE</th>
                            <th colspan="2">DADOS FINAIS</th>
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
                            <th>MF</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tbody>
                            <tr>

                                <td>AVALIADOS</td>

                                <!-- primeiro trimeste-->
                                <?php
                                $trimestre1 = ControladorNotas::getNotasEstudantesPDF($getHorario->id_turma, $getHorario->id_disciplina, $getHorario->ano_lectivo, 1);
                                foreach ($trimestre1 as $valor1){
                                //lancados
                                if($valor1->mac !=null){
                                $count_avaliados1['mac']=$count_avaliados1['mac']+1;
                                }

                                if($valor1->npp !=null){
                                $count_avaliados1['npp']=$count_avaliados1['npp']+1;
                                }
                                if($valor1->pt !=null){
                                $count_avaliados1['pt']=$count_avaliados1['pt']+1;
                                }

                                if($valor1->mt !=null){
                                $count_avaliados1['mt']=$count_avaliados1['mt']+1;
                                }
                               //end

                            //positivas
                             if($valor1->mac >=5){
                              $count_positivas1['mac']=$count_positivas1['mac']+1;
                              }
                              if($valor1->npp >=5){
                             $count_positivas1['npp']=$count_positivas1['npp']+1;
                             }
                             if($valor1->pt >=5){
                             $count_positivas1['pt']=$count_positivas1['pt']+1;
                             }
                            if($valor1->mt >=5){
                             $count_positivas1['mt']=$count_positivas1['mt']+1;
                            }
                           //end

                           //negativas
                           if($valor1->mac <=4.99 && $valor1->mac !=null){
                              $count_negativas1['mac']=$count_negativas1['mac']+1;
                              }
                              if($valor1->npp <=4.99 && $valor1->npp !=null){
                             $count_negativas1['npp']=$count_negativas1['npp']+1;
                             }
                             if($valor1->pt <=4.99 && $valor1->pt !=null){
                             $count_negativas1['pt']=$count_negativas1['pt']+1;
                             }
                            if($valor1->mt <=4.99 && $valor1->mt !=null){
                             $count_negativas1['mt']=$count_negativas1['mt']+1;
                            }
                           //end

                            }
                             ?>
                                                            <td>{{$count_avaliados1['mac']}}</td>
                                                            <td>{{$count_avaliados1['npp']}}</td>
                                                            <td>{{$count_avaliados1['pt']}}</td>
                                                            <td>{{$count_avaliados1['mt']}}</td>

                                                            <!-- end primeiro trimeste-->

                                                            <!-- segundo trimeste-->
                                                            <?php
                                                                $trimestre2 = ControladorNotas::getNotasEstudantesPDF($getHorario->id_turma, $getHorario->id_disciplina, $getHorario->ano_lectivo, 2);
                                                                foreach ($trimestre2 as $valor2){
                                                                    //lancados
                                                                    if($valor2->mac !=null){
                                                                        $count_avaliados2['mac']=$count_avaliados2['mac']+1;
                                                                    }

                                                                    if($valor2->npp !=null){
                                                                        $count_avaliados2['npp']=$count_avaliados2['npp']+1;
                                                                    }

                                                                    if($valor2->pt !=null){
                                                                        $count_avaliados2['pt']=$count_avaliados2['pt']+1;
                                                                    }

                                                                    if($valor2->mt !=null){
                                                                        $count_avaliados2['mt']=$count_avaliados2['mt']+1;
                                                                    }
                                                                    //end

                                                                    //positivas
                                                                    if($valor2->mac >=5){
                                                                        $count_positivas2['mac']=$count_positivas2['mac']+1;
                                                                    }

                                                                    if($valor2->npp >=5){
                                                                        $count_positivas2['npp']=$count_positivas2['npp']+1;
                                                                    }

                                                                    if($valor2->pt >=5){
                                                                        $count_positivas2['pt']=$count_positivas2['pt']+1;
                                                                    }

                                                                    if($valor2->mt >=5){
                                                                        $count_positivas2['mt']=$count_positivas2['mt']+1;
                                                                    }
                                                                    //end

                            //negativas
                           if($valor2->mac <=4.99 && $valor2->mac !=null){
                              $count_negativas2['mac']=$count_negativas2['mac']+1;
                              }
                              if($valor2->npp <=4.99 && $valor2->npp !=null){
                             $count_negativas2['npp']=$count_negativas2['npp']+1;
                             }
                             if($valor2->pt <=4.99 && $valor2->pt !=null){
                             $count_negativas2['pt']=$count_negativas2['pt']+1;
                             }
                            if($valor2->mt <=4.99 && $valor2->mt !=null){
                             $count_negativas2['mt']=$count_negativas2['mt']+1;
                            }
                           //end
                                                                }
                                                                ?>
                                                            <td>{{$count_avaliados2['mac']}}</td>
                                                            <td>{{$count_avaliados2['npp']}}</td>
                                                            <td>{{$count_avaliados2['pt']}}</td>
                                                            <td>{{$count_avaliados2['mt']}}</td>

                                                            <!-- end segundo trimeste-->

                                                           <!-- terceiro trimeste-->
                                                           <?php
                                                           $trimestre3 = ControladorNotas::getNotasEstudantesPDF($getHorario->id_turma, $getHorario->id_disciplina, $getHorario->ano_lectivo, 3);
                                                           foreach ($trimestre3 as $valor3){
                                                               //lancados
                                                               if($valor3->mac !=null){
                                                                   $count_avaliados3['mac']=$count_avaliados3['mac']+1;
                                                               }

                                                               if($valor3->npp !=null){
                                                                   $count_avaliados3['npp']=$count_avaliados3['npp']+1;
                                                               }

                                                               if($valor3->pt !=null){
                                                                   $count_avaliados3['pt']=$count_avaliados3['pt']+1;
                                                               }

                                                               if($valor3->mt !=null){
                                                                   $count_avaliados3['mt']=$count_avaliados3['mt']+1;
                                                               }
                                                               //end


                                                                    //positivas
                                                                    if($valor3->mac >=5){
                                                                        $count_positivas3['mac']=$count_positivas3['mac']+1;
                                                                    }

                                                                    if($valor3->npp >=5){
                                                                        $count_positivas3['npp']=$count_positivas3['npp']+1;
                                                                    }

                                                                    if($valor3->pt >=5){
                                                                        $count_positivas3['pt']=$count_positivas3['pt']+1;
                                                                    }

                                                                    if($valor3->mt >=5){
                                                                        $count_positivas3['mt']=$count_positivas3['mt']+1;
                                                                    }
                                                                    //end
                            //negativas
                           if($valor3->mac <=4.99 && $valor3->mac !=null){
                              $count_negativas3['mac']=$count_negativas3['mac']+1;
                              }
                              if($valor3->npp <=4.99 && $valor3->npp !=null){
                             $count_negativas3['npp']=$count_negativas3['npp']+1;
                             }
                             if($valor3->pt <=4.99 && $valor3->pt !=null){
                             $count_negativas3['pt']=$count_negativas3['pt']+1;
                             }
                            if($valor3->mt <=4.99 && $valor3->mt !=null){
                             $count_negativas3['mt']=$count_negativas3['mt']+1;
                            }
                           //end
                                                           }
                                                           ?>
                                                       <td>{{$count_avaliados3['mac']}}</td>
                                                       <td>{{$count_avaliados3['npp']}}</td>
                                                       <td>{{$count_avaliados3['pt']}}</td>
                                                       <td>{{$count_avaliados3['mt']}}</td>

                                                       <!-- end terceiro trimeste-->

                                                       <!-- finals -->
                                                       <?php
                                                           $finals = ControladorNotas::getNotasEstudantesFinalPDF($getHorario->id_turma, $getHorario->id_disciplina, $getHorario->ano_lectivo);
                                                           foreach ($finals as $valorf){
                                                               //lancados
                                                               if($valorf->mfd !=null){
                                                                   $count_avaliadosf['mfd']=$count_avaliadosf['mfd']+1;
                                                               }

                                                               if($valorf->mf !=null){
                                                                   $count_avaliadosf['mf']=$count_avaliadosf['mf']+1;
                                                               }
                                                               //end

                                                            //positivas
                                                               if($valorf->mfd >=5){
                                                                   $count_positivasf['mfd']=$count_positivasf['mfd']+1;
                                                               }

                                                               if($valorf->mf >=5){
                                                                   $count_positivasf['mf']=$count_positivasf['mf']+1;
                                                               }
                                                               //end

                                                               //negativas
                                                               if($valorf->mfd <=4.99 && $valorf->mfd !=null){
                                                                   $count_negativasf['mfd']=$count_negativasf['mfd']+1;
                                                               }

                                                               if($valorf->mf <=4.99 && $valorf->mf !=null){
                                                                   $count_negativasf['mf']=$count_negativasf['mf']+1;
                                                               }
                                                               //end
                                                           }
                                                           ?>
                                                        <td>{{$count_avaliadosf['mfd']}}</td>
                                                        <td>{{$count_avaliadosf['mf']}}</td>
                                                        <!-- end finals-->
                            </tr>

                            <tr>
                                <td>POSITIVAS</td>

                                <td>{{$count_positivas1['mac']}}</td>
                                <td>{{$count_positivas1['npp']}}</td>
                                <td>{{$count_positivas1['pt']}}</td>
                                <td>{{$count_positivas1['mt']}}</td>

                                <td>{{$count_positivas2['mac']}}</td>
                                <td>{{$count_positivas2['npp']}}</td>
                                <td>{{$count_positivas2['pt']}}</td>
                                <td>{{$count_positivas2['mt']}}</td>

                                <td>{{$count_positivas3['mac']}}</td>
                                <td>{{$count_positivas3['npp']}}</td>
                                <td>{{$count_positivas3['pt']}}</td>
                                <td>{{$count_positivas3['mt']}}</td>

                                <td>{{$count_positivasf['mfd']}}</td>
                                <td>{{$count_positivasf['mf']}}</td>
                            </tr>

                            <tr>
                                <td>NEGATIVAS</td>

                                <td>{{$count_negativas1['mac']}}</td>
                                <td>{{$count_negativas1['npp']}}</td>
                                <td>{{$count_negativas1['pt']}}</td>
                                <td>{{$count_negativas1['mt']}}</td>

                                <td>{{$count_negativas2['mac']}}</td>
                                <td>{{$count_negativas2['npp']}}</td>
                                <td>{{$count_negativas2['pt']}}</td>
                                <td>{{$count_negativas2['mt']}}</td>

                                <td>{{$count_negativas3['mac']}}</td>
                                <td>{{$count_negativas3['npp']}}</td>
                                <td>{{$count_negativas3['pt']}}</td>
                                <td>{{$count_negativas3['mt']}}</td>

                                <td>{{$count_negativasf['mfd']}}</td>
                                <td>{{$count_negativasf['mf']}}</td>
                            </tr>

                            <tr>
                                <?php
                                //primeiro trimestre
                                if($count_avaliados1['mac']==0){
                                    $percent_positivas1['mac']=0;
                                }else{
                                    $percent_positivas1['mac'] = ($count_positivas1['mac']*100)/$count_avaliados1['mac'];
                                }
                                if($count_avaliados1['npp']==0){
                                    $percent_positivas1['npp']=0;
                                }else{
                                    $percent_positivas1['npp'] = ($count_positivas1['npp']*100)/$count_avaliados1['npp'];
                                }
                                if($count_avaliados1['pt']==0){
                                    $percent_positivas1['pt']=0;
                                }else{
                                    $percent_positivas1['pt'] = ($count_positivas1['pt']*100)/$count_avaliados1['pt'];
                                }
                                if($count_avaliados1['mt']==0){
                                    $percent_positivas1['mt']=0;
                                }else{
                                    $percent_positivas1['mt'] = ($count_positivas1['mt']*100)/$count_avaliados1['mt'];
                                }

                                //end primeiro trimestre

                                //segundo trimestre
                                if($count_avaliados2['mac']==0){
                                    $percent_positivas2['mac']=0;
                                }else{
                                    $percent_positivas2['mac'] = ($count_positivas2['mac']*100)/$count_avaliados2['mac'];
                                }
                                if($count_avaliados2['npp']==0){
                                    $percent_positivas2['npp']=0;
                                }else{
                                    $percent_positivas2['npp'] = ($count_positivas2['npp']*100)/$count_avaliados2['npp'];
                                }
                                if($count_avaliados2['pt']==0){
                                    $percent_positivas2['pt']=0;
                                }else{
                                    $percent_positivas2['pt'] = ($count_positivas2['pt']*100)/$count_avaliados2['pt'];
                                }
                                if($count_avaliados2['mt']==0){
                                    $percent_positivas2['mt']=0;
                                }else{
                                    $percent_positivas2['mt'] = ($count_positivas2['mt']*100)/$count_avaliados2['mt'];
                                }

                                //end segundo trimestre

                                //terceiro trimestre
                                if($count_avaliados3['mac']==0){
                                    $percent_positivas3['mac']=0;
                                }else{
                                $percent_positivas3['mac'] = ($count_positivas3['mac']*100)/$count_avaliados3['mac'];
                                }
                                if($count_avaliados3['npp']==0){
                                    $percent_positivas3['npp']=0;
                                }else{
                                $percent_positivas3['npp'] = ($count_positivas3['npp']*100)/$count_avaliados3['npp'];
                                }
                                if($count_avaliados3['pt']==0){
                                    $percent_positivas3['pt']=0;
                                }else{
                                $percent_positivas3['pt'] = ($count_positivas3['pt']*100)/$count_avaliados3['pt'];
                                }
                                if($count_avaliados3['mt']==0){
                                    $percent_positivas3['mt']=0;
                                }else{
                                $percent_positivas3['mt'] = ($count_positivas3['mt']*100)/$count_avaliados3['mt'];
                                }

                                //end terceiro trimestre

                                //terceiro trimestre
                                if($count_avaliadosf['mfd']==0){
                                    $percent_positivasf['mfd'] = 0;
                                }else{
                                    $percent_positivasf['mfd'] = ($count_positivasf['mfd']*100)/$count_avaliadosf['mfd'];
                                }

                                if($count_avaliadosf['mf']==0){
                                    $percent_positivasf['mf'] = 0;
                                }else{
                                    $percent_positivasf['mf'] = ($count_positivasf['mf']*100)/$count_avaliadosf['mf'];
                                }


                                //end terceiro trimestre
                                    ?>
                                <td>% POSITIVAS</td>

                                <td>{{round($percent_positivas1['mac'],2)}}%</td>
                                <td>{{round($percent_positivas1['npp'],2)}}%</td>
                                <td>{{round($percent_positivas1['pt'],2)}}%</td>
                                <td>{{round($percent_positivas1['mt'],2)}}%</td>

                                <td>{{round($percent_positivas2['mac'],2)}}%</td>
                                <td>{{round($percent_positivas2['npp'],2)}}%</td>
                                <td>{{round($percent_positivas2['pt'],2)}}%</td>
                                <td>{{round($percent_positivas2['mt'],2)}}%</td>

                                <td>{{round($percent_positivas3['mac'],2)}}%</td>
                                <td>{{round($percent_positivas3['npp'],2)}}%</td>
                                <td>{{round($percent_positivas3['pt'],2)}}%</td>
                                <td>{{round($percent_positivas3['mt'],2)}}%</td>

                                <td>{{round($percent_positivasf['mfd'],2)}}%</td>
                                <td>{{round($percent_positivasf['mf'],2)}}%</td>
                            </tr>

                            <tr>
                                <?php
                                //primeiro trimestre
                                if($count_avaliados1['mac']==0){
                                    $percent_negativas1['mac']=0;
                                }else{
                                    $percent_negativas1['mac'] = ($count_negativas1['mac']*100)/$count_avaliados1['mac'];
                                }
                                if($count_avaliados1['npp']==0){
                                    $percent_negativas1['npp']=0;
                                }else{
                                    $percent_negativas1['npp'] = ($count_negativas1['npp']*100)/$count_avaliados1['npp'];
                                }
                                if($count_avaliados1['pt']==0){
                                    $percent_negativas1['pt']=0;
                                }else{
                                    $percent_negativas1['pt'] = ($count_negativas1['pt']*100)/$count_avaliados1['pt'];
                                }
                                if($count_avaliados1['mt']==0){
                                    $percent_negativas1['mt']=0;
                                }else{
                                    $percent_negativas1['mt'] = ($count_negativas1['mt']*100)/$count_avaliados1['mt'];
                                }

                                //end primeiro trimestre

                                //segundo trimestre
                                if($count_avaliados2['mac']==0){
                                    $percent_negativas2['mac']=0;
                                }else{
                                    $percent_negativas2['mac'] = ($count_negativas2['mac']*100)/$count_avaliados2['mac'];
                                }
                                if($count_avaliados2['npp']==0){
                                    $percent_negativas2['npp']=0;
                                }else{
                                    $percent_negativas2['npp'] = ($count_negativas2['npp']*100)/$count_avaliados2['npp'];
                                }
                                if($count_avaliados2['pt']==0){
                                    $percent_negativas2['pt']=0;
                                }else{
                                    $percent_negativas2['pt'] = ($count_negativas2['pt']*100)/$count_avaliados2['pt'];
                                }
                                if($count_avaliados2['mt']==0){
                                    $percent_negativas2['mt']=0;
                                }else{
                                    $percent_negativas2['mt'] = ($count_negativas2['mt']*100)/$count_avaliados2['mt'];
                                }

                                //end segundo trimestre

                                //terceiro trimestre
                                if($count_avaliados3['mac']==0){
                                    $percent_negativas3['mac']=0;
                                }else{
                                $percent_negativas3['mac'] = ($count_negativas3['mac']*100)/$count_avaliados3['mac'];
                                }
                                if($count_avaliados3['npp']==0){
                                    $percent_negativas3['npp']=0;
                                }else{
                                $percent_negativas3['npp'] = ($count_negativas3['npp']*100)/$count_avaliados3['npp'];
                                }
                                if($count_avaliados3['pt']==0){
                                    $percent_negativas3['pt']=0;
                                }else{
                                $percent_negativas3['pt'] = ($count_negativas3['pt']*100)/$count_avaliados3['pt'];
                                }
                                if($count_avaliados3['mt']==0){
                                    $percent_negativas3['mt']=0;
                                }else{
                                $percent_negativas3['mt'] = ($count_negativas3['mt']*100)/$count_avaliados3['mt'];
                                }

                                //end terceiro trimestre

                                //terceiro trimestre
                                if($count_avaliadosf['mfd']==0){
                                    $percent_negativasf['mfd'] = 0;
                                }else{
                                    $percent_negativasf['mfd'] = ($count_negativasf['mfd']*100)/$count_avaliadosf['mfd'];
                                }

                                if($count_avaliadosf['mf']==0){
                                    $percent_negativasf['mf'] = 0;
                                }else{
                                    $percent_negativasf['mf'] = ($count_negativasf['mf']*100)/$count_avaliadosf['mf'];
                                }


                                //end terceiro trimestre
                                    ?>
                                <td>% NEGATIVAS</td>

                                <td>{{round($percent_negativas1['mac'],2)}}%</td>
                                <td>{{round($percent_negativas1['npp'],2)}}%</td>
                                <td>{{round($percent_negativas1['pt'],2)}}%</td>
                                <td>{{round($percent_negativas1['mt'],2)}}%</td>

                                <td>{{round($percent_negativas2['mac'],2)}}%</td>
                                <td>{{round($percent_negativas2['npp'],2)}}%</td>
                                <td>{{round($percent_negativas2['pt'],2)}}%</td>
                                <td>{{round($percent_negativas2['mt'],2)}}%</td>

                                <td>{{round($percent_negativas3['mac'],2)}}%</td>
                                <td>{{round($percent_negativas3['npp'],2)}}%</td>
                                <td>{{round($percent_negativas3['pt'],2)}}%</td>
                                <td>{{round($percent_negativas3['mt'],2)}}%</td>

                                <td>{{round($percent_negativasf['mfd'],2)}}%</td>
                                <td>{{round($percent_negativasf['mf'],2)}}%</td>
                            </tr>


                        </tbody>
                    </tbody>
                </table>
            </div>

         </div>
         <br/><br/>
         <div class="rodape">
            <div class="teacher_name">
                O(A) PROFESSOR(A)<br/>
                _____________________<br/>
                //{{$getHorario->funcionario->pessoa->nome}}//
            </div>
         </div>
    </div>
<!-- end estatistica-->

<!-- segunda pagina -->
    <div class="page-break">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold;">MINI-PAUTA 1º TRIMESTRE</p>
         </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                &nbsp;&nbsp;{{$getHorario->ano_lectivo}} - [ {{strtoupper($getHorario->turma->turma)}} - {{strtoupper($getHorario->turma->curso->curso)}} ] - DISCIPLINA: {{strtoupper($getHorario->disciplina->disciplina)}}
            </div>
            <div class="periodo">
                PERÍODO: {{strtoupper($getHorario->turma->turno->turno)}}
                &nbsp;&nbsp;
                <br/>
        </div>
         </div>
         <br/>
         <div class="corpo">

            <div class="table-responsive tabela">
                <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>NOME COMPLETO</th>
                            <th>G</th>
                            <th>OUT</th>
                            <th>NOV</th>
                            <th>DEZ</th>
                            <th>MAC1</th>
                            <th>NPP1</th>
                            <th>PT1</th>
                            <th>MT1</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($getHistorico as $historico)
                      <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$historico->estudante->pessoa->nome}}</td>
                          <td>{{$historico->estudante->pessoa->genero}}</td>

                          <!-- primeiro trimestre-->
                          <?php
                              $trimestre1 = ControladorNotas::getValoresMiniPautaTrimestralPDF($getHorario->id_disciplina, $historico->id_estudante, 1, $getHorario->ano_lectivo);
                              if($trimestre1->count()==0){
                          ?>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                          <td>---</td>
                              <?php }
                              else{
                                  foreach($trimestre1 as $valor1){
                                      $v01_estilo = ControladorNotas::nota_10Qualitativa($valor1->av1);
                                      $v02_estilo = ControladorNotas::nota_10Qualitativa($valor1->av2);
                                      $v03_estilo = ControladorNotas::nota_10Qualitativa($valor1->av3);

                                      $v1_estilo = ControladorNotas::nota_10Qualitativa($valor1->mac);
                                      $v2_estilo = ControladorNotas::nota_10Qualitativa($valor1->npp);
                                      $v3_estilo = ControladorNotas::nota_10Qualitativa($valor1->pt);
                                      $v4_estilo = ControladorNotas::nota_10Qualitativa($valor1->mt);


                                      $v01_valor = ControladorNotas::estado_nota_qualitativa($valor1->av1);
                                      $v02_valor = ControladorNotas::estado_nota_qualitativa($valor1->av2);
                                      $v03_valor = ControladorNotas::estado_nota_qualitativa($valor1->av3);

                                      $v1_valor = ControladorNotas::estado_nota_qualitativa($valor1->mac);
                                      $v2_valor = ControladorNotas::estado_nota_qualitativa($valor1->npp);
                                      $v3_valor = ControladorNotas::estado_nota_qualitativa($valor1->pt);
                                      $v4_valor = ControladorNotas::estado_nota_qualitativa($valor1->mt);
                                  ?>

                                      <td class="{{$v01_estilo}}">@if($valor1->av1==null) --- @else {{$v01_valor}} @endif</td>
                                      <td class="{{$v02_estilo}}">@if($valor1->av2==null) --- @else {{$v02_valor}} @endif</td>
                                      <td class="{{$v03_estilo}}">@if($valor1->av3==null) --- @else {{$v03_valor}} @endif</td>
                                      <td class="{{$v1_estilo}}">@if($valor1->mac==null) --- @else {{$v1_valor}} @endif</td>
                                      <td class="{{$v2_estilo}}">@if($valor1->npp==null) --- @else {{$v2_valor}} @endif</td>
                                      <td class="{{$v3_estilo}}">@if($valor1->pt==null) --- @else {{$v3_valor}} @endif</td>
                                      <td class="{{$v4_estilo}}">@if($valor1->mt==null) --- @else {{$v4_valor}} @endif</td>
                                  <?php }}?>
                          <!-- fim primeiro trimestre-->

                      </tr>
                      @endforeach
                    </tbody>
                 </table>

            </div>

         </div>
         <br/><br/>
         <div class="rodape">
            <div class="teacher_name">
                O(A) PROFESSOR(A)<br/>
                _____________________<br/>
                //{{$getHorario->funcionario->pessoa->nome}}//
            </div>
         </div>
    </div>
<!-- end segunda pagina -->

<!-- terceira pagina -->
    <div class="page-break">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold;">MINI-PAUTA 2º TRIMESTRE</p>
         </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                &nbsp;&nbsp;{{$getHorario->ano_lectivo}} - [ {{strtoupper($getHorario->turma->turma)}} - {{strtoupper($getHorario->turma->curso->curso)}} ] - DISCIPLINA: {{strtoupper($getHorario->disciplina->disciplina)}}
            </div>
            <div class="periodo">
                PERÍODO: {{strtoupper($getHorario->turma->turno->turno)}}
                &nbsp;&nbsp;
                <br/>
            </div>
         </div>
         <br/>
         <div class="corpo">

            <div class="table-responsive tabela">

                <div class="table-responsive tabela">
                    <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>NOME COMPLETO</th>
                                <th>G</th>
                                <th>JAN</th>
                                <th>FEV</th>
                                <th>MAR</th>
                                <th>MAC2</th>
                                <th>NPP2</th>
                                <th>PT2</th>
                                <th>MT2</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($getHistorico as $historico)
                          <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$historico->estudante->pessoa->nome}}</td>
                              <td>{{$historico->estudante->pessoa->genero}}</td>

                              <!-- primeiro trimestre-->
                              <?php
                                  $trimestre2 = ControladorNotas::getValoresMiniPautaTrimestralPDF($getHorario->id_disciplina, $historico->id_estudante, 2, $getHorario->ano_lectivo);
                                  if($trimestre2->count()==0){
                              ?>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
                                  <?php }
                                  else{
                                      foreach($trimestre2 as $valor2){
                                          $v01_estilo = ControladorNotas::nota_10Qualitativa($valor2->av1);
                                          $v02_estilo = ControladorNotas::nota_10Qualitativa($valor2->av2);
                                          $v03_estilo = ControladorNotas::nota_10Qualitativa($valor2->av3);

                                          $v1_estilo = ControladorNotas::nota_10Qualitativa($valor2->mac);
                                          $v2_estilo = ControladorNotas::nota_10Qualitativa($valor2->npp);
                                          $v3_estilo = ControladorNotas::nota_10Qualitativa($valor2->pt);
                                          $v4_estilo = ControladorNotas::nota_10Qualitativa($valor2->mt);


                                          $v01_valor = ControladorNotas::estado_nota_qualitativa($valor2->av1);
                                          $v02_valor = ControladorNotas::estado_nota_qualitativa($valor2->av2);
                                          $v03_valor = ControladorNotas::estado_nota_qualitativa($valor2->av3);

                                          $v1_valor = ControladorNotas::estado_nota_qualitativa($valor2->mac);
                                          $v2_valor = ControladorNotas::estado_nota_qualitativa($valor2->npp);
                                          $v3_valor = ControladorNotas::estado_nota_qualitativa($valor2->pt);
                                          $v4_valor = ControladorNotas::estado_nota_qualitativa($valor2->mt);
                                      ?>

                                          <td class="{{$v01_estilo}}">@if($valor2->av1==null) --- @else {{$v01_valor}} @endif</td>
                                          <td class="{{$v02_estilo}}">@if($valor2->av2==null) --- @else {{$v02_valor}} @endif</td>
                                          <td class="{{$v03_estilo}}">@if($valor2->av3==null) --- @else {{$v03_valor}} @endif</td>
                                          <td class="{{$v1_estilo}}">@if($valor2->mac==null) --- @else {{$v1_valor}} @endif</td>
                                          <td class="{{$v2_estilo}}">@if($valor2->npp==null) --- @else {{$v2_valor}} @endif</td>
                                          <td class="{{$v3_estilo}}">@if($valor2->pt==null) --- @else {{$v3_valor}} @endif</td>
                                          <td class="{{$v4_estilo}}">@if($valor2->mt==null) --- @else {{$v4_valor}} @endif</td>
                                      <?php }}?>
                              <!-- fim primeiro trimestre-->

                          </tr>
                          @endforeach
                        </tbody>
                     </table>

                </div>

            </div>

         </div>
         <br/><br/>
         <div class="rodape">
            <div class="teacher_name">
                O(A) PROFESSOR(A)<br/>
                _____________________<br/>
                //{{$getHorario->funcionario->pessoa->nome}}//
            </div>
         </div>
     </div>
<!-- end pagina -->


<!-- terceira pagina -->
<div class="page-break">
    <div class="cabecalho">
        @include('include.header_docs')
    </div>
    <div class="titulo">
        <p style="text-align: center; font-weight:bold;">MINI-PAUTA 3º TRIMESTRE</p>
     </div>
    <div class="mini-cabecalho">
        <div class="ano_curso">
            &nbsp;&nbsp;{{$getHorario->ano_lectivo}} - [ {{strtoupper($getHorario->turma->turma)}} - {{strtoupper($getHorario->turma->curso->curso)}} ] - DISCIPLINA: {{strtoupper($getHorario->disciplina->disciplina)}}
        </div>
        <div class="periodo">
            PERÍODO: {{strtoupper($getHorario->turma->turno->turno)}}
            &nbsp;&nbsp;
            <br/>
        </div>
     </div>
     <br/>
     <div class="corpo">

        <div class="table-responsive tabela">
            <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>NOME COMPLETO</th>
                        <th>G</th>
                        <th>ABR</th>
                        <th>MAI</th>
                        <th>JUN</th>
                        <th>MAC3</th>
                        <th>NPP3</th>
                        <th>PT3</th>
                        <th>MT3</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($getHistorico as $historico)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$historico->estudante->pessoa->nome}}</td>
                      <td>{{$historico->estudante->pessoa->genero}}</td>

                      <!-- primeiro trimestre-->
                      <?php
                          $trimestre3 = ControladorNotas::getValoresMiniPautaTrimestralPDF($getHorario->id_disciplina, $historico->id_estudante, 3, $getHorario->ano_lectivo);
                          if($trimestre3->count()==0){
                      ?>
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                          <?php }
                          else{
                              foreach($trimestre3 as $valor3){
                                  $v01_estilo = ControladorNotas::nota_10Qualitativa($valor3->av1);
                                  $v02_estilo = ControladorNotas::nota_10Qualitativa($valor3->av2);
                                  $v03_estilo = ControladorNotas::nota_10Qualitativa($valor3->av3);

                                  $v1_estilo = ControladorNotas::nota_10Qualitativa($valor3->mac);
                                  $v2_estilo = ControladorNotas::nota_10Qualitativa($valor3->npp);
                                  $v3_estilo = ControladorNotas::nota_10Qualitativa($valor3->pt);
                                  $v4_estilo = ControladorNotas::nota_10Qualitativa($valor3->mt);


                                  $v01_valor = ControladorNotas::estado_nota_qualitativa($valor3->av1);
                                  $v02_valor = ControladorNotas::estado_nota_qualitativa($valor3->av2);
                                  $v03_valor = ControladorNotas::estado_nota_qualitativa($valor3->av3);

                                  $v1_valor = ControladorNotas::estado_nota_qualitativa($valor3->mac);
                                  $v2_valor = ControladorNotas::estado_nota_qualitativa($valor3->npp);
                                  $v3_valor = ControladorNotas::estado_nota_qualitativa($valor3->pt);
                                  $v4_valor = ControladorNotas::estado_nota_qualitativa($valor3->mt);
                              ?>

                                  <td class="{{$v01_estilo}}">@if($valor3->av1==null) --- @else {{$v01_valor}} @endif</td>
                                  <td class="{{$v02_estilo}}">@if($valor3->av2==null) --- @else {{$v02_valor}} @endif</td>
                                  <td class="{{$v03_estilo}}">@if($valor3->av3==null) --- @else {{$v03_valor}} @endif</td>
                                  <td class="{{$v1_estilo}}">@if($valor3->mac==null) --- @else {{$v1_valor}} @endif</td>
                                  <td class="{{$v2_estilo}}">@if($valor3->npp==null) --- @else {{$v2_valor}} @endif</td>
                                  <td class="{{$v3_estilo}}">@if($valor3->pt==null) --- @else {{$v3_valor}} @endif</td>
                                  <td class="{{$v4_estilo}}">@if($valor3->mt==null) --- @else {{$v4_valor}} @endif</td>
                              <?php }}?>
                      <!-- fim primeiro trimestre-->

                  </tr>
                  @endforeach
                </tbody>
             </table>


        </div>

     </div>
     <br/><br/>
     <div class="rodape">
        <div class="teacher_name">
            O(A) PROFESSOR(A)<br/>
            _____________________<br/>
            //{{$getHorario->funcionario->pessoa->nome}}//
        </div>
     </div>
 </div>

 <!-- end pagina -->

</body>
</html>

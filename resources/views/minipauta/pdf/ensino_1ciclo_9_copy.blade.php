<?php
use App\Http\Controllers\ControladorNotas;
?>
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
        font-size: 11px;
        margin-left: 10px;
        margin-right: 10px;
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
    .nenhum{
        color: #333;
    }
    table thead{
            background-color: #4680ff;
            color: #fff;
    }
    .tabela{
        font-size: 11px;
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
            <div class="table-responsive tabela">
             <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;" bordercolor="red">
                   <thead>
                       <tr>
                           <th rowspan="2">Nº</th>
                           <th rowspan="2">NOME COMPLETO</th>
                           <th rowspan="2">G</th>
                           <th colspan="4">1º TRIMESTRE</th>
                           <th colspan="4">2º TRIMESTRE</th>
                           <th colspan="4">3º TRIMESTRE</th>
                           <th colspan="3">DADOS FINAIS</th>
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
                           <th>NPE</th>
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
                             $trimestre1 = ControladorNotas::getValoresMiniPautaTrimestral($historico->id_estudante, 1);
                             if($trimestre1->count()==0){
                         ?>
                         <td>---</td>
                         <td>---</td>
                         <td>---</td>
                         <td>---</td>
                             <?php }
                             else{
                                 foreach($trimestre1 as $valor1){
                                     $v1_estilo = ControladorNotas::nota_20($valor1->mac);
                                     $v2_estilo = ControladorNotas::nota_20($valor1->npp);
                                     $v3_estilo = ControladorNotas::nota_20($valor1->pt);
                                     $v4_estilo = ControladorNotas::nota_20($valor1->mt);
                                 ?>

                         <td class="{{$v1_estilo}}">@if($valor1->mac==null) --- @else {{$valor1->mac}} @endif</td>
                         <td class="{{$v2_estilo}}">@if($valor1->npp==null) --- @else {{$valor1->npp}} @endif</td>
                         <td class="{{$v3_estilo}}">@if($valor1->pt==null) --- @else {{$valor1->pt}} @endif</td>
                         <td class="{{$v4_estilo}}">@if($valor1->mt==null) --- @else {{$valor1->mt}} @endif</td>
                                 <?php }}?>
                         <!-- fim primeiro trimestre-->

                         <!-- segundo trimestre-->
                         <?php
                             $trimestre2 = ControladorNotas::getValoresMiniPautaTrimestral($historico->id_estudante, 2);
                             if($trimestre2->count()==0){
                         ?>
                         <td>---</td>
                         <td>---</td>
                         <td>---</td>
                         <td>---</td>
                             <?php }
                             else{
                                 foreach($trimestre2 as $valor2){
                                     $v1_estilo = ControladorNotas::nota_20($valor2->mac);
                                     $v2_estilo = ControladorNotas::nota_20($valor2->npp);
                                     $v3_estilo = ControladorNotas::nota_20($valor2->pt);
                                     $v4_estilo = ControladorNotas::nota_20($valor2->mt);
                                 ?>

                         <td class="{{$v1_estilo}}">@if($valor2->mac==null) --- @else {{$valor2->mac}} @endif</td>
                         <td class="{{$v2_estilo}}">@if($valor2->npp==null) --- @else {{$valor2->npp}} @endif</td>
                         <td class="{{$v3_estilo}}">@if($valor2->pt==null) --- @else {{$valor2->pt}} @endif</td>
                         <td class="{{$v4_estilo}}">@if($valor2->mt==null) --- @else {{$valor2->mt}} @endif</td>
                                 <?php }}?>
                         <!-- fim segundo trimestre-->

                          <!-- terceiro trimestre-->
                          <?php
                          $trimestre3 = ControladorNotas::getValoresMiniPautaTrimestral($historico->id_estudante, 3);
                          if($trimestre3->count()==0){
                      ?>
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                      <td>---</td>
                          <?php }
                          else{
                              foreach($trimestre3 as $valor3){
                                  $v1_estilo = ControladorNotas::nota_20($valor3->mac);
                                  $v2_estilo = ControladorNotas::nota_20($valor3->npp);
                                  $v3_estilo = ControladorNotas::nota_20($valor3->pt);
                                  $v4_estilo = ControladorNotas::nota_20($valor3->mt);
                              ?>

                      <td class="{{$v1_estilo}}">@if($valor3->mac==null) --- @else {{$valor3->mac}} @endif</td>
                      <td class="{{$v2_estilo}}">@if($valor3->npp==null) --- @else {{$valor3->npp}} @endif</td>
                      <td class="{{$v3_estilo}}">@if($valor3->pt==null) --- @else {{$valor3->pt}} @endif</td>
                      <td class="{{$v4_estilo}}">@if($valor3->mt==null) --- @else {{$valor3->mt}} @endif</td>
                              <?php }}?>
                      <!-- fim terceiro trimestre-->

                      <!-- dados finais-->
                      <?php
                         $final = ControladorNotas::getValoresMiniPautaFinal($historico->id_estudante);
                         if($final->count() == 0){
                      ?>
                         <td>---</td>
                         <td>---</td>
                         <td>---</td>
                     <?php }
                         else{
                             foreach ($final as $valorf){
                             $v1_estilo = ControladorNotas::nota_20($valorf->mfd);
                             $v2_estilo = ControladorNotas::nota_20($valorf->npe);
                             $v3_estilo = ControladorNotas::nota_20($valorf->mf);
                     ?>
                         <td class="{{$v1_estilo}}">@if($valorf->mfd==null) --- @else {{$valorf->mfd}} @endif</td>
                         <td class="{{$v2_estilo}}">@if($valorf->npe==null) --- @else {{$valorf->npe}} @endif</td>
                         <td class="{{$v3_estilo}}">@if($valorf->mf==null) --- @else {{$valorf->mf}} @endif</td>
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

<!-- segunda pagina -->
    <div class="page-break">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold;">MINI-PAUTA DE AVALIAÇÃO ANUAL</p>
         </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                &nbsp;&nbsp;{{$getHorario->ano_lectivo}} - [ {{strtoupper($getHorario->turma->turma)}} - {{strtoupper($getHorario->turma->curso->curso)}} ]
            </div>
            <div class="periodo">
                PERÍODO: {{strtoupper($getHorario->turma->turno->turno)}}
                &nbsp;&nbsp;
                <br/>
        </div>
         </div>
         <br/><br/>
         <div class="corpo">



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
            <p style="text-align: center; font-weight:bold;">MINI-PAUTA DE AVALIAÇÃO ANUAL</p>
         </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                &nbsp;&nbsp;{{$getHorario->ano_lectivo}} - [ {{strtoupper($getHorario->turma->turma)}} - {{strtoupper($getHorario->turma->curso->curso)}} ]
            </div>
            <div class="periodo">
                PERÍODO: {{strtoupper($getHorario->turma->turno->turno)}}
                &nbsp;&nbsp;
                <br/>
            </div>
         </div>
         <br/><br/>
         <div class="corpo">
            corpo
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

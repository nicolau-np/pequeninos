<?php
use App\Http\Controllers\ControladorStatic;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mini Pauta</title>
</head>
<style>
    .positivo{
        color: #4680ff;
    }
    .negativo{
        color: red;
    }
    .nenhum{
        color: #333;
    }
    .tabela{
        font-size: 12px;
    }
    table thead{
        background-color: #4680ff;
        color: #fff;
    }
    table thead th{
        font-weight: normal;
    }
</style>
<body>

    <div class="row">
        <div class="col-lg-12 col-xl-12">
        <div class="table-responsive tabela">
            <table class="table table-bordered table-striped">
               <thead>
                   <tr>
                       <th rowspan="2">Nº</th>
                       <th rowspan="2">ESTUDANTE</th>
                       <th rowspan="2">G</th>
                       <th colspan="3">I TRIMESTRE</th>
                       <th colspan="3">II TRIMESTRE</th>
                       <th colspan="3">III TRIMESTRE</th>
                       <th colspan="3">DADOS FINAIS</th>
                   </tr>
                   <tr>
                     <th>MAC</th>
                     <th>CPP</th>
                     <th>CT</th>

                     <th>MAC</th>
                     <th>CPP</th>
                     <th>CT</th>

                     <th>MAC</th>
                     <th>CPP</th>
                     <th>CT</th>

                     <th>CAP</th>
                     <th>CPE</th>
                     <th>CF</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($getHistorico as $historico)
                   <tr>
                   <td>{{$loop->iteration}}</td>
                   <td>{{$historico->estudante->pessoa->nome}}</td>
                   <td>{{$historico->estudante->pessoa->genero}}</td>


                   <!-- 1 trimestre-->
                   <?php
                   $trimestre1 = ControladorStatic::getValoresMiniPautaTrimestral($historico->id_estudante, 1);
                   if($trimestre1->count() == 0){?>
                    <td class="nenhum">---</td>
                    <td class="nenhum">---</td>
                    <td class="nenhum">---</td>
                   <?php }
                   else{
                   foreach ($trimestre1 as $valor1) {
                         $v1_estilo = ControladorStatic::nota_20($valor1->mac);
                         $v2_estilo = ControladorStatic::nota_20($valor1->cpp);
                         $v3_estilo = ControladorStatic::nota_20($valor1->ct);
                     ?>
                      <td class="{{$v1_estilo}}">@if($valor1->mac == null) --- @else {{$valor1->mac}} @endif</td>
                      <td class="{{$v2_estilo}}">@if($valor1->cpp == null) --- @else {{$valor1->cpp}} @endif</td>
                      <td class="{{$v3_estilo}}">@if($valor1->ct == null) --- @else {{$valor1->ct}} @endif</td>
                   <?php }} ?>
                   <!-- fim 1 trimestre-->

                   <!-- 2 trimestre-->
                   <?php
                   $trimestre2 = ControladorStatic::getValoresMiniPautaTrimestral($historico->id_estudante, 2);
                   if($trimestre2->count() == 0){?>
                    <td class="nenhum">---</td>
                    <td class="nenhum">---</td>
                    <td class="nenhum">---</td>
                   <?php }
                   else{
                   foreach ($trimestre2 as $valor2) {
                     $v1_estilo = ControladorStatic::nota_20($valor2->mac);
                     $v2_estilo = ControladorStatic::nota_20($valor2->cpp);
                     $v3_estilo = ControladorStatic::nota_20($valor2->ct);
                     ?>
                      <td class="{{$v1_estilo}}">@if($valor2->mac == null) --- @else {{$valor2->mac}} @endif</td>
                      <td class="{{$v2_estilo}}">@if($valor2->cpp == null) --- @else {{$valor2->cpp}} @endif</td>
                      <td class="{{$v3_estilo}}">@if($valor2->ct == null) --- @else {{$valor2->ct}} @endif</td>
                   <?php }} ?>
                   <!-- fim 2 trimestre-->

                 <!-- 3 trimestre-->
                 <?php
                 $trimestre3 = ControladorStatic::getValoresMiniPautaTrimestral($historico->id_estudante, 3);
                 if($trimestre3->count() == 0){?>
                 <td class="nenhum">---</td>
                 <td class="nenhum">---</td>
                 <td class="nenhum">---</td>
                 <?php }
                 else{
                     foreach ($trimestre3 as $valor3) {
                     $v1_estilo = ControladorStatic::nota_20($valor3->mac);
                     $v2_estilo = ControladorStatic::nota_20($valor3->cpp);
                     $v3_estilo = ControladorStatic::nota_20($valor3->ct);
                 ?>
                 <td class="{{$v1_estilo}}">@if($valor3->mac == null) --- @else {{$valor3->mac}} @endif</td>
                 <td class="{{$v2_estilo}}">@if($valor3->cpp == null) --- @else {{$valor3->cpp}} @endif</td>
                 <td class="{{$v3_estilo}}">@if($valor3->ct == null) --- @else {{$valor3->ct}} @endif</td>
                 <?php }} ?>
                 <!-- fim 3 trimestre-->


                   <!-- finais-->
                 <?php
                 $final = ControladorStatic::getValoresMiniPautaFinal($historico->id_estudante);
                 if($final->count() == 0){?>
                 <td class="nenhum">---</td>
                 <td class="nenhum">---</td>
                 <td class="nenhum">---</td>
                 <?php }
                 else{
                     foreach ($final as $valorf) {
                     $v1_estilo = ControladorStatic::nota_20($valorf->cap);
                     $v2_estilo = ControladorStatic::nota_20($valorf->cpe);
                     $v3_estilo = ControladorStatic::nota_20($valorf->cf);
                 ?>
                 <td class="{{$v1_estilo}}">@if($valorf->cap == null) --- @else {{$valorf->cap}} @endif</td>
                 <td class="{{$v2_estilo}}">@if($valorf->cpe == null) --- @else {{$valorf->cpe}} @endif</td>
                 <td class="{{$v3_estilo}}">@if($valorf->cf == null) --- @else {{$valorf->cf}} @endif</td>
                 <?php }} ?>
                 <!-- fim finais-->

                   </tr>
                 @endforeach
               </tbody>
            </table>
        </div>
         </div>
     </div>
</body>
</html>

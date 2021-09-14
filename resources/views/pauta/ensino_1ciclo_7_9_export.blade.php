<?php
use App\Http\Controllers\ControladorStatic;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pauta</title>
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
</head>
<body>
    <div class="table-responsive tabela">
        <table class="table table-bordered table-striped">
           <thead>

               <tr>
                   <th rowspan="2">Nº</th>
                   <th rowspan="2">ESTUDANTE</th>
                   <th rowspan="2">G</th>
                   <?php
                   foreach(Session::get('disciplinas') as $disciplina){
                     $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina'])
                     ?>
                   <th colspan="3">{{$getDisciplina->disciplina}}</th>
                   <?php
                   }
                   ?>
               </tr>
               <tr>
                 @foreach (Session::get('disciplinas') as $disciplina)
                 <th>CAP</th>
                 <th>CPE</th>
                 <th>CF</th>
                 @endforeach
               </tr>
           </thead>
       <tbody>
           @foreach ($getHistorico as $historico)
                <tr>
                <td>{{$loop->iteration}}</td>
                 <td>{{$historico->estudante->pessoa->nome}}</td>
                 <td>{{$historico->estudante->pessoa->genero}}</td>


                 <!-- finais-->
             <?php
             foreach (Session::get('disciplinas') as $disciplina) {

             $final = ControladorStatic::getValoresMiniPautaFinal2($historico->id_estudante, $disciplina["id_disciplina"]);
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
             <?php
             }}

             }?>
             <!-- fim finais-->

             </tr>
           @endforeach

       </tbody>
        </table>
    </div>

</body>
</html>

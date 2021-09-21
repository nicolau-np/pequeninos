@php
use App\Http\Controllers\ControladorNotas;
@endphp
@extends('layouts.app')
@section('content')
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
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->turma->turma}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->disciplina->disciplina}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->ano_lectivo}}
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
                           <table class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th rowspan="2">Nº</th>
                                      <th rowspan="2">NOME COMPLETO</th>
                                      <th rowspan="2">G</th>
                                      <th colspan="4">1º TRIMESTRE</th>
                                      <th colspan="4">2º TRIMESTRE</th>
                                      <th colspan="4">3º TRIMESTRE</th>
                                      <th colspan="2">-</th>
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
                                <?php }
                                    else{
                                        foreach ($final as $valorf){
                                        $v1_estilo = ControladorNotas::nota_20($valorf->mfd);
                                        $v2_estilo = ControladorNotas::nota_20($valorf->mf);
                                ?>
                                    <td class="{{$v1_estilo}}">@if($valorf->mfd==null) --- @else {{$valorf->mfd}} @endif</td>
                                    <td class="{{$v2_estilo}}">@if($valorf->mf==null) --- @else {{$valorf->mf}} @endif</td>
                                <?php }}?>
                                <!-- fim dados finais-->

                                <!-- obs -->
                                @if($final->count()==0)
                                        <td>---</td>
                                        @else
                                        <td class="@if($valorf->mf<=9.9) negativo @else positivo @endif">
                                            @if($valorf->mf<=9.9) Reprovado @else Aprovado @endif
                                        </td>
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
		<a href="/cadernetas/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

@endsection

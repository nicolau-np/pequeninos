@php 
use App\Http\Controllers\ControladorStatic;
@endphp
@extends('layouts.app')
@section('content')
<style>
    .positivo{
        color: blue;
    }
    .negativo{
        color: red;
    }
    .nenhum{
        color: #333;
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
                       <div class="tabela">
                           <table class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th>Nº</th>
                                      <th>Nome do Estudante</th>
                                      <th>Gênero</th>
                                      <th colspan="3">I Trimestre</th>
                                      <th colspan="3">II Trimestre</th>
                                      <th colspan="3">III Trimestre</th>
                                      <th colspan="3">Dados Finais</th>
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
                                   <td>---</td>
                                   <td>---</td>
                                   <td>---</td> 
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
                                   <td>---</td>
                                   <td>---</td>
                                   <td>---</td> 
                                  <?php }
                                  else{
                                  foreach ($trimestre2 as $valor2) { 
                                    ?>
                                     <td>@if($valor2->mac == null) --- @else {{$valor2->mac}} @endif</td>
                                     <td>@if($valor2->cpp == null) --- @else {{$valor2->cpp}} @endif</td>
                                     <td>@if($valor2->ct == null) --- @else {{$valor2->ct}} @endif</td> 
                                  <?php }} ?>
                                  <!-- fim 2 trimestre-->

                                <!-- 3 trimestre-->
                                <?php 
                                $trimestre3 = ControladorStatic::getValoresMiniPautaTrimestral($historico->id_estudante, 3);
                                if($trimestre3->count() == 0){?>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td> 
                                <?php }
                                else{
                                    foreach ($trimestre3 as $valor3) { 
                                ?>
                                <td>@if($valor3->mac == null) --- @else {{$valor3->mac}} @endif</td>
                                <td>@if($valor3->cpp == null) --- @else {{$valor3->cpp}} @endif</td>
                                <td>@if($valor3->ct == null) --- @else {{$valor3->ct}} @endif</td> 
                                <?php }} ?>
                                <!-- fim 3 trimestre-->


                                  <!-- finais-->
                                <?php 
                                $final = ControladorStatic::getValoresMiniPautaFinal($historico->id_estudante);
                                if($final->count() == 0){?>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td> 
                                <?php }
                                else{
                                    foreach ($final as $valorf) { 
                                ?>
                                <td>@if($valorf->cap == null) --- @else {{$valorf->cap}} @endif</td>
                                <td>@if($valorf->cpe == null) --- @else {{$valorf->cpe}} @endif</td>
                                <td>@if($valorf->cf == null) --- @else {{$valorf->cf}} @endif</td> 
                                <?php }} ?>
                                <!-- fim finais-->

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
@php
use App\Http\Controllers\ControladorNotas;
use App\Http\Controllers\ControladorStatic;
@endphp
@extends('layouts.app')
@section('content')
<?php
$observacao_geral = ControladorNotas::observacao_geral($getDirector->turma->classe->id,$getDirector->turma->curso->id);
if(!$observacao_geral){
    $observacao_geralDB=22;
}else{
    $observacao_geralDB= $observacao_geral->quantidade_negativas;
}
?>
<style>

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
                    {{$getDirector->turma->turma}}
                    <i class="ti-angle-right"></i>
                    {{$getDirector->turma->turno->turno}}
                    <i class="ti-angle-right"></i>
                    {{$getDirector->turma->curso->curso}}
                    <i class="ti-angle-right"></i>
                    {{$getDirector->ano_lectivo}}
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
                                      <?php
                                      foreach(Session::get('disciplinas') as $disciplina){
                                        $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina'])
                                        ?>
                                      <th colspan="3">{{strtoupper($getDisciplina->disciplina)}}</th>
                                      <?php } ?>
                                      <th rowspan="2">OBSERVAÇÃO</th>
                                  </tr>
                                  <tr>
                                    @foreach (Session::get('disciplinas') as $disciplina)
                                    <th>MFD</th>
                                    <th>NPE</th>
                                    <th>MF</th>
                                    @endforeach
                                 </tr>
                              </thead>
                              <tbody>
                                  <?php
                                    $defice_disciplinas = [];
                                    $count_obs=0;
                                    $observacao_final = false;

                                    $numero_cadeiras = 0;
                                    $numero_lancados = 0;
                                  ?>
                                @foreach ($getHistorico as $historico)
                                    <?php
                                            $numero_cadeiras = 0;
                                            $numero_lancados = 0;
                                            $observacao_final = false;
                                            $count_obs = 0;
                                            $observacao_especifica=false;

                                            $defice_disciplinas = [];
                                    ?>
                                  <tr class="{{$historico->observacao_final}}">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$historico->estudante->pessoa->nome}}</td>
                                    <td>{{$historico->estudante->pessoa->genero}}</td>

                                    <?php
                                    foreach (Session::get('disciplinas') as $disciplina) {
                                        $numero_cadeiras = $numero_cadeiras + 1;
                                        $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante, $disciplina["id_disciplina"], $getDirector->ano_lectivo);
                                        if($final->count() == 0){
                                        ?>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    <?php } else {
                                        foreach ($final as $valorf) {
                                        $v1_estilo = ControladorNotas::nota_20($valorf->mfd);
                                        $v2_estilo = ControladorNotas::nota_20($valorf->npe);
                                        $v3_estilo = ControladorNotas::nota_20($valorf->mf);
                                        ?>
                                        <td class="{{$v1_estilo}}">@if($valorf->mfd == null) --- @else {{$valorf->mfd}} @endif</td>
                                        <td class="{{$v2_estilo}}">@if($valorf->npe == null) --- @else {{$valorf->npe}} @endif</td>
                                        <td class="{{$v3_estilo}}">@if($valorf->mf == null) --- @else {{$valorf->mf}} @endif</td>

                                    <?php }
                                            if($valorf->mf<=4.99 && $valorf->mf!=null){
                                            //conta disciplinas com negativa
                                            $count_obs ++;
                                            //adiciona disciplinas com defices no array
                                            array_push($defice_disciplinas, $valorf->disciplina->disciplina);
                                            //faz a verificacao na observacao geral do controlador static, caso encontrar entao esta reprovado a variavel observacao vai ficar true caso nao encontrar prossiga
                                            $observacao_especifica = ControladorNotas::observacao_especifica($getDirector->turma->classe->id, $getDirector->turma->curso->id, $disciplina["id_disciplina"]);
                                            }

                                            if($count_obs >= $observacao_geralDB){
                                                $observacao_final = true;
                                            }
                                            if($observacao_especifica){
                                                $observacao_final = true;
                                            }

                                            if($valorf->mf!=null){
                                            $numero_lancados = $numero_lancados +1;
                                            }
                                        }


                                        }
                                        ?>

                                        @if($numero_cadeiras != $numero_lancados)
                                        <td>---</td>
                                        @else
                                        <td class="@if($observacao_final) negativo @else positivo @endif">
                                            @if($observacao_final)
                                                 NÃO TRANSITA
                                             @else
                                             TRANSITA
                                             @if ($defice_disciplinas)
                                                [DEF.(
                                                    @foreach ($defice_disciplinas as $item)
                                                       {{strtoupper($item)}},
                                                    @endforeach
                                                    )]
                                                @endif
                                             @endif


                                         </td>
                                        @endif

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
		<a href="/minha_turma/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

@endsection

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
                                      <th rowspan="2" style="width:47px;">FOTO</th>
                                      <th rowspan="2">NOME COMPLETO</th>
                                      <th rowspan="2">G</th>
                                      <?php

                                      foreach(Session::get('disciplinas') as $disciplina){
                                        $numero_colspan = 2;
                                        $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                                        $getCadeiraExame = ControladorStatic::getExameStatus($getDirector->turma->id_curso, $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                        $getCadeiraRecurso = ControladorStatic::getRecursoStatus($getDirector->turma->id_curso, $getDirector->turma->id_classe, $disciplina['id_disciplina']);

                                        if($getCadeiraExame){
                                            $numero_colspan = $numero_colspan + 1;
                                        }

                                        if($getCadeiraRecurso){
                                            $numero_colspan = $numero_colspan + 1;
                                        }
                                        ?>
                                      <th colspan="{{$numero_colspan}}">{{strtoupper($getDisciplina->disciplina)}}</th>
                                      <?php } ?>
                                      <th rowspan="2">OBSERVAÇÃO</th>
                                  </tr>
                                  <tr>
                                    @foreach (Session::get('disciplinas') as $disciplina)
                                    <?php
                                        $getCadeiraExame = ControladorStatic::getExameStatus($getDirector->turma->id_curso, $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                        $getCadeiraRecurso = ControladorStatic::getRecursoStatus($getDirector->turma->id_curso, $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                    ?>
                                    <th>MFD</th>
                                    @if($getCadeiraExame)
                                    <th>NPE</th>
                                    @endif
                                    <th>MF</th>
                                    @if($getCadeiraRecurso)
                                    <th>REC</th>
                                    @endif
                                    @endforeach
                                 </tr>
                              </thead>
                              <tbody>

                                @foreach ($getHistorico as $historico)

                                  <tr class="{{$historico->observacao_final}}">
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <img src="
                                            @if($historico->estudante->pessoa->foto)
                                            {{asset($historico->estudante->pessoa->foto)}}
                                            @else
                                            {{asset('assets/template/images/profile.png')}}
                                            @endif
                                            " alt="" style="width:47px; height:47px; border-radius:4px;">
                                    </td>
                                    <td>{{$historico->estudante->pessoa->nome}}</td>
                                    <td>{{$historico->estudante->pessoa->genero}}</td>

                                    <?php
                                    foreach (Session::get('disciplinas') as $disciplina) {

                                        $getCadeiraExame = ControladorStatic::getExameStatus($getDirector->turma->id_curso, $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                        $getCadeiraRecurso = ControladorStatic::getRecursoStatus($getDirector->turma->id_curso, $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                                        $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante, $disciplina["id_disciplina"], $getDirector->ano_lectivo);
                                        if($final->count() == 0){
                                        ?>
                                        <td>---</td>
                                        @if ($getCadeiraExame)
                                        <td>---</td>
                                        @endif
                                        <td>---</td>
                                        @if ($getCadeiraRecurso)
                                        <td>---</td>
                                        @endif
                                    <?php } else {
                                        foreach ($final as $valorf) {
                                        $v1_estilo = ControladorNotas::nota_10Qualitativa($valorf->mfd);
                                        if($getCadeiraExame){
                                        $v2_estilo = ControladorNotas::nota_10Qualitativa($valorf->npe);
                                        }
                                        $v3_estilo = ControladorNotas::nota_10Qualitativa($valorf->mf);
                                        if($getCadeiraRecurso){
                                        $v4_estilo = ControladorNotas::notaRec_5($valorf->rec);
                                        }

                                        $v1_valor = ControladorNotas::estado_nota_qualitativa($valorf->mfd);
                                        if($getCadeiraExame){
                                        $v2_valor = ControladorNotas::estado_nota_qualitativa($valorf->npe);
                                        }
                                        $v3_valor = ControladorNotas::estado_nota_qualitativa($valorf->mf);
                                        if($getCadeiraRecurso){
                                        $v4_valor = ControladorNotas::estado_nota_qualitativaRec($valorf->rec);
                                        }
                                        ?>
                                        <td class="{{$v1_estilo}}">@if($valorf->mfd==null) --- @else {{$v1_valor}} @endif</td>
                                        @if ($getCadeiraExame)
                                            <td class="{{$v2_estilo}}">@if($valorf->npe==null) --- @else {{$v2_valor}} @endif</td>
                                        @endif
                                        <td class="{{$v3_estilo}}">@if($valorf->mf==null) --- @else {{$v3_valor}} @endif</td>
                                        @if ($getCadeiraRecurso)
                                            <td class="{{$v4_estilo}}">@if($valorf->rec==null) --- @else {{$v4_valor}} @endif</td>
                                        @endif

                                    <?php }

                                        }
                                        }
                                        ?>
                                        <!-- obs -->
                                        <td>-----</td>
                                         <!-- fim obs-->
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
		<a href="/minha_turma/create/{{$getDirector->id_turma}}/{{$getDirector->ano_lectivo}}" type="button" class="btn btn-primary btnCircular btnPrincipal" title="Voltar"><i class="ti-arrow-left"></i></a>
	</div>
</div>

@endsection

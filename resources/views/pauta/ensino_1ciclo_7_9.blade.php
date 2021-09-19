@php
use App\Http\Controllers\ControladorStatic;
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
                    {{$getDirector->turma->turma}}
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
                                      <th rowspan="2">OBSERVAÇÃO</th>
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
                                <td></td>
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

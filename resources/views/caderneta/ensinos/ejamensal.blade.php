<?php
use App\Http\Controllers\ControladorStatic;
?>
@extends('layouts.app')
@section('content')
<style>

    .npe{
        width: 80px;
    }
    .rec{
        width: 80px;
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
                    {{$getHorario->turma->turno->turno}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->turma->curso->curso}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->disciplina->disciplina}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->ano_lectivo}}
                    <i class="ti-angle-right"></i>

                    <a href="/cadernetas/store_copy_ejamensal/{{$getHorario->id_turma}}/{{$getHorario->id_disciplina}}/{{session('epoca')}}/{{$getHorario->ano_lectivo}}"><i class="ti-reload"></i></a>

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
                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="col-md-12">
                        <p style="font-size: 14px;">
                            <label class="badge badge-success">TPC=> [0-1] => TAREFA DE CASA</label>&nbsp;&nbsp;&nbsp;
                            <label class="badge badge-primary">OC=> [0-1] => ORGANIZAÇÃO DO CADERNO</label>&nbsp;&nbsp;&nbsp;
                            <label class="badge badge-danger">PA=> [0-1] => PARTICIPAÇÃO NAS AULAS</label>&nbsp;&nbsp;&nbsp;
                            <label class="badge badge-info">PG=> [0-1] => PARTICIPAÇÃO NOS GRUPOS</label>&nbsp;&nbsp;&nbsp;
                            <label class="badge badge-warning">TP=> [0-10] => TESTE DO PROFESSOR</label>&nbsp;&nbsp;&nbsp;
                        </p>

                    </div>


                    <div class="col-md-8">
                        <a href="/cadernetas/ejamensal/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/{{session('epoca')}}/1" class="@if($getSemana==1) btn btn-primary @else btn btn-inverse @endif">1ª SEMANA</a>&nbsp;&nbsp;
                        <a href="/cadernetas/ejamensal/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/{{session('epoca')}}/2" class="@if($getSemana==2) btn btn-primary @else btn btn-inverse @endif">2ª SEMANA</a>&nbsp;&nbsp;
                        <a href="/cadernetas/ejamensal/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/{{session('epoca')}}/3" class="@if($getSemana==3) btn btn-primary @else btn btn-inverse @endif">3ª SEMANA</a>&nbsp;&nbsp;
                        <a href="/cadernetas/ejamensal/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/{{session('epoca')}}/4" class="@if($getSemana==4) btn btn-primary @else btn btn-inverse @endif">4ª SEMANA</a>&nbsp;&nbsp;
                    </div>

                    <div class="col-lg-12 col-xl-12">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">
                            @if ($getEpoca1->estado!="off")
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="1") active @endif" href="/cadernetas/ejamensal/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/1/1">1º TRIMESTRE</a>
                                <div class="slide"></div>
                            </li>
                            @endif
                            @if ($getEpoca2->estado!="off")
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="2") active @endif" href="/cadernetas/ejamensal/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/2/1">2º TRIMESTRE</a>
                                <div class="slide"></div>
                            </li>
                            @endif
                            @if ($getEpoca3->estado!="off")
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="3") active @endif" href="/cadernetas/ejamensal/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/3/1">3º TRIMESTRE</a>
                                <div class="slide"></div>
                            </li>
                            @endif

                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs-left-content card-block">
                            @if ($getEpoca1->estado!="off")
                            <div class="tab-pane @if(session('epoca')=="1") active @endif" role="tabpanel">
                                <p class="m-0">

                                    {{Form::open(['method'=>"post"])}}
                                        <table class="table table-bordered tabela_notas">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">DADOS PESSOAIS</th>
                                                    <th colspan="5">{{$getSemana}}ª SEMANA</th>
                                                </tr>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>NOME</th>
                                                    <th>G</th>

                                                    <th>TPC</th>
                                                    <th>OC</th>
                                                    <th>PA</th>
                                                    <th>PG</th>
                                                    <th>TP</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if (session('epoca')==1)
                                                    @if ($getMensal!=null)
                                                        @if ($getMensal->count()==0)
                                                            Nenhum estudante encontrado
                                                        @else
                                                            @foreach ($getMensal as $mensal)
                                                            <?php
                                                                $observacao = ControladorStatic::getObservacaofinal($mensal->id_estudante, $mensal->ano_lectivo);
                                                            ?>
                                                                <tr class="{{$observacao->observacao_final}}">
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$mensal->estudante->pessoa->nome}}</td>
                                                                <td>{{$mensal->estudante->pessoa->genero}}</td>

                                                                <td>
                                                                    <input type="number" name="tpc{{$getSemana}}" data-id="{{$mensal->id}}" data-campo="tpc{{$getSemana}}" value="
                                                                    @if($getSemana==1)
                                                                    {{$mensal->tpc1}}
                                                                    @elseif($getSemana==2)
                                                                    {{$mensal->tpc2}}
                                                                    @elseif($getSemana==3)
                                                                    {{$mensal->tpc3}}
                                                                    @elseif($getSemana==4)
                                                                    {{$mensal->tpc4}}
                                                                    @endif
                                                                    " class="form-control mensal" />
                                                                </td>

                                                                <td>
                                                                    <input type="number" name="oc{{$getSemana}}" data-id="{{$mensal->id}}" data-campo="oc{{$getSemana}}" value="
                                                                    @if($getSemana==1)
                                                                    {{$mensal->oc1}}
                                                                    @elseif($getSemana==2)
                                                                    {{$mensal->oc2}}
                                                                    @elseif($getSemana==3)
                                                                    {{$mensal->oc3}}
                                                                    @elseif($getSemana==4)
                                                                    {{$mensal->oc4}}
                                                                    @endif
                                                                    " class="form-control mensal" />
                                                                </td>

                                                                <td>
                                                                    <input type="number" name="pa{{$getSemana}}" data-id="{{$mensal->id}}" data-campo="pa{{$getSemana}}" value="
                                                                    @if($getSemana==1)
                                                                    {{$mensal->pa1}}
                                                                    @elseif($getSemana==2)
                                                                    {{$mensal->pa2}}
                                                                    @elseif($getSemana==3)
                                                                    {{$mensal->pa3}}
                                                                    @elseif($getSemana==4)
                                                                    {{$mensal->pa4}}
                                                                    @endif
                                                                    " class="form-control mensal" />
                                                                </td>

                                                                <td>
                                                                    <input type="number" name="pg{{$getSemana}}" data-id="{{$mensal->id}}" data-campo="pg{{$getSemana}}" value="
                                                                    @if($getSemana==1)
                                                                    {{$mensal->pg1}}
                                                                    @elseif($getSemana==2)
                                                                    {{$mensal->pg2}}
                                                                    @elseif($getSemana==3)
                                                                    {{$mensal->pg3}}
                                                                    @elseif($getSemana==4)
                                                                    {{$mensal->pg4}}
                                                                    @endif
                                                                    " class="form-control mensal" />
                                                                </td>

                                                                <td>
                                                                    <input type="number" name="tp{{$getSemana}}" data-id="{{$mensal->id}}" data-campo="tp{{$getSemana}}" value="
                                                                    @if($getSemana==1)
                                                                    {{$mensal->tp1}}
                                                                    @elseif($getSemana==2)
                                                                    {{$mensal->tp2}}
                                                                    @elseif($getSemana==3)
                                                                    {{$mensal->tp3}}
                                                                    @elseif($getSemana==4)
                                                                    {{$mensal->tp4}}
                                                                    @endif
                                                                    " class="form-control mensal" />
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endif
                                            </tbody>
                                        </table>
                                    {{Form::close()}}
                                 </p>
                            </div>
                            @endif

                            @if ($getEpoca2->estado!="off")
                            <div class="tab-pane @if(session('epoca')=="2") active @endif" role="tabpanel">
                                <p class="m-0">
                                    {{Form::open(['method'=>"post"])}}
                                    <table class="table table-bordered tabela_notas">
                                        <thead>
                                            <tr>
                                                <th colspan="3">DADOS PESSOAIS</th>
                                                <th colspan="3">AVALIAÇÕES</th>
                                                <th colspan="2">PROVAS</th>
                                            </tr>
                                            <tr>
                                                <th>Nº</th>
                                                <th>NOME</th>
                                                <th>G</th>
                                                <th>JAN</th>
                                                <th>FEV</th>
                                                <th>MAR</th>
                                                <th>NPP</th>
                                                <th>PT</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (session('epoca')==2)
                                                @if ($getMensal!=null)
                                                    @if ($getMensal->count()==0)
                                                        Nenhum estudante encontrado
                                                    @else
                                                        @foreach ($getMensal as $mensal)
                                                        <?php
                                                                $observacao = ControladorStatic::getObservacaofinal($mensal->id_estudante, $mensal->ano_lectivo);
                                                            ?>
                                                                <tr class="{{$observacao->observacao_final}}">
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$mensal->estudante->pessoa->nome}}</td>
                                                            <td>{{$mensal->estudante->pessoa->genero}}</td>


                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
                                    {{Form::close()}}
                                </p>
                            </div>
                            @endif

                            @if ($getEpoca3->estado!="off")
                            <div class="tab-pane @if(session('epoca')=="3") active @endif" role="tabpanel">
                                <p class="m-0">
                                    {{Form::open(['method'=>"post"])}}
                                    <table class="table table-bordered tabela_notas">
                                        <thead>
                                            <tr>
                                                <th colspan="3">DADOS PESSOAIS</th>
                                                <th colspan="3">AVALIAÇÕES</th>
                                                <th colspan="2">PROVAS</th>
                                            </tr>
                                            <tr>
                                                <th>Nº</th>
                                                <th>NOME</th>
                                                <th>G</th>
                                                <th>ABR</th>
                                                <th>MAI</th>
                                                <th>JUN</th>
                                                <th>NPP</th>
                                                <th>PT</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (session('epoca')==3)
                                                @if ($getMensal!=null)
                                                    @if ($getMensal->count()==0)
                                                        Nenhum estudante encontrado
                                                    @else
                                                        @foreach ($getMensal as $mensal)
                                                        <?php
                                                                $observacao = ControladorStatic::getObservacaofinal($mensal->id_estudante, $mensal->ano_lectivo);
                                                            ?>
                                                                <tr class="{{$observacao->observacao_final}}">
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$mensal->estudante->pessoa->nome}}</td>
                                                            <td>{{$mensal->estudante->pessoa->genero}}</td>


                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
                                    {{Form::close()}}
                                </p>
                            </div>
                            @endif



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
        <a href="/cadernetas/list/{{$getHorario->ano_lectivo}}" class="btn btn-primary btnCircular btnPrincipal" title="Voltar"><i class="ti-arrow-left"></i></a>
	</div>
</div>

@endsection

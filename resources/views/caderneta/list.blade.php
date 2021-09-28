<?php
use App\Http\Controllers\ControladorStatic;

$epoca_usar = 0;
if(($getEpoca1->estado=="on")){
    $epoca_usar = 1;
}

if(($getEpoca2->estado=="on")){
    $epoca_usar = 2;
}

if(($getEpoca3->estado=="on")){
    $epoca_usar = 3;
}

if(($getEpoca4->estado=="on")){
    $epoca_usar = 4;
}

if(($getEpoca1->estado=="off")){
$epoca_usar = 2;
}

if(($getEpoca1->estado=="off") && ($getEpoca2->estado=="off")){
    $epoca_usar = 3;
}

if(($getEpoca1->estado=="off") && ($getEpoca2->estado=="off") && ($getEpoca3->estado=="off")){
    $epoca_usar = 4;
}

if(($getEpoca1->estado=="off") && ($getEpoca2->estado=="off") && ($getEpoca3->estado=="off") && ($getEpoca4->estado=="off")){
    $epoca_usar = 1;
}

if(($getEpoca1->estado=="on") && ($getEpoca2->estado=="on") && ($getEpoca3->estado=="on") && ($getEpoca4->estado=="on")){
    $epoca_usar = 1;
}


?>
@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}

                    @foreach ($getAnos as $anos)
                    <i class="ti-angle-right"></i>
                        <a href="/cadernetas/list/{{$anos->ano_lectivo}}" style="color:#4680ff;">{{$anos->ano_lectivo}}</a>
                    @endforeach
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
                    <div class="col-md-12">
                         @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    </div>


                    @if($getHorario->count()==0)
                        <div class="col-md-12 col-xl-12">
                            Nenhuma turma encontrada
                        </div>
                    @else
                    @foreach ($getHorario as $horario)
                    <?php
                        $numero_estudantes = 0;
                        $getEstudantes = ControladorStatic::getTotalEstudantesTurma($horario->id_turma, $horario->ano_lectivo);
                        $numero_estudantes = $getEstudantes->count();
                     ?>
                    <div class="col-md-4 col-xl-4">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-file-alt bg-c-blue card1-icon"></i>
                            <span class="text-c-blue f-w-600">{{$horario->disciplina->disciplina}}</span>
                            <h4 style="font-size:20px;">{{$horario->turma->turma}}&nbsp;{{$horario->turma->turno->turno}}</h4>
                                <div>
                                    <span class="f-left m-t-10 text-muted">
                                        Ano: {{$horario->ano_lectivo}} &nbsp;&nbsp; <b>[ {{$numero_estudantes}} ]</b>
                                        <hr/>
                                       <div class="operacoes">
                                       <a href="/cadernetas/create/{{$horario->id_turma}}/{{$horario->id_disciplina}}/{{$horario->ano_lectivo}}/{{$epoca_usar}}" type="button" class="btn btn-primary btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="left" title="" data-original-title="Inserir Notas">
                                            <i class="icofont icofont-edit-alt"></i>
                                        </a>&nbsp;
                                        <a href="/minipautas/show/{{$horario->id_turma}}/{{$horario->id_disciplina}}/{{$horario->ano_lectivo}}" type="button" class="btn btn-danger btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mini Pauta">
                                            <i class="icofont icofont-clip-board"></i>
                                        </a>&nbsp;
                                        <a href="/estatisticas/minipautas/list/{{$horario->id_turma}}/{{$horario->id_disciplina}}/{{$horario->ano_lectivo}}" type="button" class="btn btn-success btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="right" title="" data-original-title="Estatística">
                                            <i class="icofont icofont-chart-bar-graph"></i>
                                        </a>&nbsp;
                                        <a href="/cadernetas/printer/{{$horario->id_turma}}/{{$horario->id_disciplina}}/{{$horario->ano_lectivo}}" type="button" class="btn btn-warning btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="right" title="" data-original-title="Imprimir">
                                            <i class="ti-printer"></i>
                                        </a>&nbsp;
                                        <!--<a href="/cadernetas/store/{{$horario->id_turma}}/{{$horario->id_disciplina}}/{{$horario->ano_lectivo}}" type="button" class="btn btn-info btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="right" title="" data-original-title="Actualizar">
                                            <i class="icofont icofont-refresh"></i>
                                        </a>&nbsp;-->
                                       </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif


                    <div class="col-md-12 pagination">
                        {{$getHorario->links()}}
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->

@endsection

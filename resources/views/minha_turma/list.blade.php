<?php
use App\Http\Controllers\ControladorStatic;
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
                        <a href="/minha_turma/list/{{$anos->ano_lectivo}}" style="color:#4680ff;">{{$anos->ano_lectivo}}</a>
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
               @if ($getTurmas->count()==0)
                    <div class="col-md-12">Nenhuma Turma</div>
                @else
                @foreach ($getTurmas as $turmas)
                <?php
                        $numero_estudantes = 0;
                        $getEstudantes = ControladorStatic::getTotalEstudantesTurma($turmas->id_turma, $turmas->ano_lectivo);
                        $numero_estudantes = $getEstudantes->count();
                     ?>
                <div class="col-md-4 col-xl-4">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="ti-folder bg-c-blue card1-icon"></i>
                        <span class="text-c-blue f-w-600">{{$turmas->turma->curso->curso}}</span>
                        <h4 style="font-size:20px;">{{$turmas->turma->turma}}&nbsp;{{$turmas->turma->turno->turno}}</h4>
                            <div>
                                <span class="f-left m-t-10 text-muted">
                                    Ano: {{$turmas->ano_lectivo}}&nbsp;&nbsp;<b>[ {{$numero_estudantes}} ]</b>
                                    <hr/>
                                   <div class="operacoes">
                                    <a href="/pautas/create/{{$turmas->id_turma}}/{{$turmas->ano_lectivo}}" type="button" class="btn btn-danger btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pauta">
                                        <i class="icofont icofont-clip-board"></i>
                                    </a>&nbsp;

                                    <a href="/minha_turma/horario/{{$turmas->id_turma}}/{{$turmas->ano_lectivo}}" type="button" class="btn btn-primary btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="right" title="" data-original-title="Horário">
                                        <i class="icofont icofont-time"></i>
                                    </a>&nbsp;
                                    <a href="/relatorios/lista_nominal/{{$turmas->id_turma}}/{{$turmas->ano_lectivo}}" type="button" class="btn btn-success btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="right" title="" data-original-title="Lista Nominal">
                                        <i class="icofont icofont-list"></i>
                                    </a>&nbsp;
                                   </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

                  @endif
                </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->

@endsection

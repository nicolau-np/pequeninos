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
                    <h5>{{$submenu}} <i class="ti-angle-right"></i>
                        @foreach ($getAnos as $anos)
                        <a href="/turmas/list/{{$anos->ano_lectivo}}" style="color:#4680ff;">{{$anos->ano_lectivo}}</a>
                        <i class="ti-angle-right"></i>
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
                       </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">

                        <div class="card-block accordion-block color-accordion-block">
                            <div class="color-accordion" id="color-accordion">
                                @foreach ($getEnsinos as $ensinos)
                                <a class="accordion-msg b-none">{{$ensinos->ensino}}</a>
                                <div class="accordion-desc">
                                    <div class="row">
                                    @foreach ($ensinos->curso as $curso)
                                        <?php
                                            $getTurmas = ControladorStatic::getTurmaEnsino($curso->id_ensino);
                                        ?>
                                            @if ($getTurmas->count()==0)
                                                <div class="col-md-12">
                                                    <span style="font-size:12px;">Nenhuma turma encontrada para este ensino</span>
                                                </div>

                                            @else

                                                @foreach ($getTurmas as $turmas)
                                                <?php
                                                    $numero_estudantes = 0;
                                                    $getEstudantes = ControladorStatic::getTotalEstudantesTurma($turmas->id, $getAno);
                                                    $numero_estudantes = $getEstudantes->count();
                                                ?>
                                                <div class="col-md-4 col-xl-4">
                                                    <div class="card widget-card-1">
                                                        <div class="card-block-small">
                                                            <i class="ti-layers bg-c-blue card1-icon"></i>
                                                        <span class="text-c-blue f-w-600">{{$curso->curso}}</span>
                                                        <h4 style="font-size:20px;">Turma: {{$turmas->turma}}</h4>
                                                            <div>
                                                                <span class="f-left m-t-10 text-muted">
                                                                    Ano: {{$getAno}}&nbsp;&nbsp; <b>[ {{$numero_estudantes}} ]</b>
                                                                    <hr/>
                                                                <div class="operacoes">
                                                                    <a href="/relatorios/lista_nominal/{{$turmas->id}}/{{$getAno}}" type="button" class="btn btn-danger btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="left" title="" data-original-title="Lista Nominal">
                                                                        <i class="ti-printer"></i>
                                                                    </a>&nbsp;
                                                                    <a href="#" type="button" class="btn btn-success btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="right" title="" data-original-title="Estatística">
                                                                        <i class="icofont icofont-chart-bar-graph"></i>
                                                                    </a>&nbsp;
                                                                </div>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif

                                    @endforeach
                                </div>
                                </div>
                                @endforeach
                                </div>
                            </div>

                            </div>

                        </div>


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
		<a href="#" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>


@endsection

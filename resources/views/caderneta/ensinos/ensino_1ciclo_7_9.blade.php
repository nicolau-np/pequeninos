@extends('layouts.app')
@section('content')

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

                    <div class="col-lg-12 col-xl-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="1") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/1">1º Trimestre</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="2") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/2">2º Trimestre</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="3") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/3">3º Trimestre</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="4") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/4">Global</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs-left-content card-block">
                            <div class="tab-pane @if(session('epoca')=="1") active @endif" role="tabpanel">
                                <p class="m-0">
                                    1.Trimestre
                                </p>
                            </div>
                            <div class="tab-pane @if(session('epoca')=="2") active @endif" role="tabpanel">
                                <p class="m-0">
                                    2.Trimestre
                                </p>
                            </div>
                            <div class="tab-pane @if(session('epoca')=="3") active @endif" role="tabpanel">
                                <p class="m-0">
                                    3.Trimestre
                                </p>
                            </div>
                            <div class="tab-pane @if(session('epoca')=="4") active @endif" role="tabpanel">
                                <p class="m-0">
                                    Global
                                </p>
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
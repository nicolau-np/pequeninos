@php
use App\Http\Controllers\ControladorStatic;
$trimestres = ['1 Trimestre','2 Trimestre','3 Trimestre',];
@endphp
@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}} <i class="ti-angle-right"></i>
                        {{$getHorario->turma->turma}}<i class="ti-angle-right"></i>
                        {{$getHorario->disciplina->disciplina}}<i class="ti-angle-right"></i>
                        {{$getAno}}

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
                    <div>
                         @if(session('error'))
                         <div class="alert alert-danger">{{session('error')}}</div>
                         @endif
                    </div>


                    <div class="grafico">
                        <div class="col-lg-12 col-xl-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home5" role="tab">Trimestral</a>
                                    <div class="slide"></div>
                                </li>

                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabs-left-content card-block">
                                <div class="tab-pane active" id="home5" role="tabpanel">
                                    <p class="m-0">
                                        <div class="table-responsive">
                                            <!-- espaco para tabela-->

                                            <!-- fim -->
                                        </div>
                                        <!-- pagamentos trimestrais-->
                                        <figure class="highcharts-figure">
                                            <div id="container_trimestral" style="width: 100%;"></div>
                                            <p class="highcharts-description">
                                                Gráfico de barras ilustrando o aproveitamento da turma em todos os trimestres,

                                            </p>
                                        </figure>

                                       <!-- espaco para o grafico-->

                                       <!-- fim -->
                                    </p>
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


@endsection

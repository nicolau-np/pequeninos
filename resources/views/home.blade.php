@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <!-- card1 start -->
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="ti-user bg-c-blue card1-icon"></i>
                    <span class="text-c-blue f-w-600">Usuários</span>
                    <h4>{{$getUsuarios->count()}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-blue f-16 icofont icofont-warning m-r-10"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- card1 end -->
        <!-- card1 start -->
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="ti-layout-tab-v bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">Funcinários</span>
                    <h4>{{$getFuncionarios->count()}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-pink f-16 icofont icofont-calendar m-r-10"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- card1 end -->
        <!-- card1 start -->
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="ti-id-badge bg-c-green card1-icon"></i>
                    <span class="text-c-green f-w-600">Estudantes</span>
                    <h4>{{$getEstudantes->count()}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-green f-16 icofont icofont-tag m-r-10"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- card1 end -->
        <!-- card1 start -->
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="ti-layout-media-overlay-alt bg-c-yellow card1-icon"></i>
                    <span class="text-c-yellow f-w-600">Encarregados</span>
                    <h4>{{$getEncarregados->count()}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-yellow f-16 icofont icofont-refresh m-r-10"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- card1 end -->
        <!-- Statestics Start -->
        <div class="col-md-12 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h5>Bem vindo {{Auth::user()->pessoa->nome}} ao SIGE</h5>
                    <div class="card-header-left ">
                    </div>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="icofont icofont-simple-left "></i></li>
                            <li><i class="icofont icofont-maximize full-card"></i></li>
                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                            <li><i class="icofont icofont-error close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                <img src="{{asset('assets/template2/img/slide2.jpeg')}}" alt="img" style="width: 100%; height:30em;">
                </div>
            </div>
        </div>



        <div class="col-md-12 col-xl-4">
                <div class="card fb-card">
                    <div class="card-header">
                        <i class="ti-money"></i>
                        <div class="d-inline-block">
                            <h5>Pagamentos</h5>
                            <span>Módulo para propinas</span>
                        </div>
                    </div>
                    <div class="card-block text-center">
                        <div class="row">
                            <div class="col-6 b-r-default">
                                <h2>1</h2>
                                <p class="text-muted">Activar</p>
                            </div>
                            <div class="col-6">
                                <h2>2</h2>
                                <p class="text-muted">Detalhes</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card dribble-card">
                    <div class="card-header">
                        <i class="ti-receipt"></i>
                        <div class="d-inline-block">
                            <h5>Notas</h5>
                            <span>Módulo para notas</span>
                        </div>
                    </div>
                    <div class="card-block text-center">
                        <div class="row">
                            <div class="col-6 b-r-default">
                                <h2>1</h2>
                                <p class="text-muted">Activar</p>
                            </div>
                            <div class="col-6">
                                <h2>2</h2>
                                <p class="text-muted">Detalhes</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card twitter-card">
                    <div class="card-header">
                        <i class="ti-bar-chart"></i>
                        <div class="d-inline-block">
                            <h5>Estatísticas</h5>
                            <span>Estatística notas e propinas</span>
                        </div>
                    </div>
                    <div class="card-block text-center">
                        <div class="row">
                            <div class="col-6 b-r-default">
                                <h2>1</h2>
                                <p class="text-muted">Activar</p>
                            </div>
                            <div class="col-6">
                                <h2>2</h2>
                                <p class="text-muted">Detalhes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    </div>
<!-- Page-body end -->
@endsection

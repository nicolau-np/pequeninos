@php
use App\Http\Controllers\ControladorStatic;
$lastYear = ControladorStatic::getLastYear();
@endphp
@extends('layouts.app')
@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $submenu }}
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
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                            </div>

                            <div class="col-md-12">
                                <div class="row">


                                    <div class="col-md-4 col-xl-4">
                                        <a href="/mapas/balancos/geral/{{ $lastYear }}" style="text-decoration: none;">
                                            <div class="card widget-card-1">
                                                <div class="card-block-small">
                                                    <i class="ti-money bg-c-green card1-icon"></i>
                                                    <span class="text-c-pink f-w-600"
                                                        style="font-size:13px;">Geral</span>
                                                    <h4 style="font-size:17px;"> </h4>
                                                    <div>
                                                        <span class="f-left m-t-10 text-muted">
                                                            <i
                                                                class="text-c-pink f-16 ti-arrow-circle-right m-r-10"></i>Balanços
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-xl-4">
                                        <a href="/mapas/balancos/categoria/{{ $lastYear }}" style="text-decoration: none;">
                                            <div class="card widget-card-1">
                                                <div class="card-block-small">
                                                    <i class="ti-money bg-c-green card1-icon"></i>
                                                    <span class="text-c-pink f-w-600"
                                                        style="font-size:13px;">Categoria</span>
                                                    <h4 style="font-size:17px;"> </h4>
                                                    <div>
                                                        <span class="f-left m-t-10 text-muted">
                                                            <i
                                                                class="text-c-pink f-16 ti-arrow-circle-right m-r-10"></i>Balanços
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-xl-4">
                                        <a href="/mapas/balancos/diario" style="text-decoration: none;">
                                            <div class="card widget-card-1">
                                                <div class="card-block-small">
                                                    <i class="ti-money bg-c-green card1-icon"></i>
                                                    <span class="text-c-pink f-w-600"
                                                        style="font-size:13px;">Período</span>
                                                    <h4 style="font-size:17px;"> </h4>
                                                    <div>
                                                        <span class="f-left m-t-10 text-muted">
                                                            <i
                                                                class="text-c-pink f-16 ti-arrow-circle-right m-r-10"></i>Balanços
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
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
            <a href="/mapas" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-arrow-left"></i></a>
        </div>
    </div>


@endsection

@extends('layouts.app')
@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $submenu }}
                            <i class="ti-angle-right"></i>
                            {{ $getHistorico->estudante->pessoa->nome }}
                            <i class="ti-angle-right"></i>
                            {{ $getHistorico->turma->turma }}
                            <i class="ti-angle-right"></i>
                            {{ $getHistorico->turma->turno->turno }}
                            <i class="ti-angle-right"></i>
                            {{ $getHistorico->turma->curso->curso }}
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
                                elloh
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
            <a href="#" class="btn btn-primary btnCircular btnPrincipal" title="Novo"><i class="ti-plus"></i></a>
        </div>
    </div>


@endsection

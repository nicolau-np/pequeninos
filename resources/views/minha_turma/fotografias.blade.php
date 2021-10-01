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
                    <i class="ti-angle-right"></i>
                    {{$getTurma->turma}}
                    <i class="ti-angle-right"></i>
                    {{$getTurma->turno->turno}}
                    <i class="ti-angle-right"></i>
                    {{$getTurma->curso->curso}}
                    <i class="ti-angle-right"></i>
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
                <div class="row">
                    <div class="col-md-12">
                        @if(session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                        @endif

                        @if(session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th style="width:10px;">Nº</th>
                                        <th style="width:60px;">Fotografia</th>
                                        <th>Nome Completo</th>
                                        <th>Gênero</th>
                                        <th>Operações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getHistorico as $historicos)
                                    {{Form::open(['method'=>"put", 'url'=>"/minha_turma/updateFoto/{$historicos->estudante->pessoa->id}/{$historicos->ano_lectivo}/{$historicos->id_turma}", 'enctype'=>"multipart/form-data"])}}
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <img src="
                                            @if($historicos->estudante->pessoa->foto)
                                            {{asset($historicos->estudante->pessoa->foto)}}
                                            @else
                                            {{asset('assets/template/images/profile.png')}}
                                            @endif
                                            " alt="" style="width:60px; height:60px;">

                                        </td>
                                        <td>{{$historicos->estudante->pessoa->nome}}</td>
                                        <td>{{$historicos->estudante->pessoa->genero}}</td>
                                        <td>
                                            {{Form::file('foto', null, ['class'=>"form-control", 'placeholder'=>"Fotografia"])}}
                                            <div class="erro">
                                                @if($errors->has('foto'))
                                                <div class="text-danger">{{$errors->first('foto')}}</div>
                                                @endif
                                            </div>
                                           <button type="submit" class="btn btn-primary">Editar Foto</button>
                                        </td>
                                    </tr>
                                    {{Form::close()}}
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

@endsection

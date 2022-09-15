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
                                <div class="formulario">
                                    @if(session('error'))
                                    <div class="alert alert-danger">{{session('error')}}</div>
                                    @endif

                                    @if(session('success'))
                                    <div class="alert alert-success">{{session('success')}}</div>
                                    @endif
                                        {{Form::open(['method'=>"post", 'url'=>"/offline_online/"])}}
                                        @csrf
                                        <fieldset>
                                            <legend><i class="ti-download"></i> Offline (Exportar)</legend>
                                            <div class="row">


                                                <div class="col-md-3">
                                                    {{Form::label('ano_lectivo', "Ano Lectivo")}} <span class="text-danger">*</span>
                                                    {{Form::select('ano_lectivo', $getAnos, $getAno->id, ['class'=>"form-control", 'placeholder'=>"Ano Lectivo"])}}
                                                    <div class="erro">
                                                        @if($errors->has('ano_lectivo'))
                                                        <div class="text-danger">{{$errors->first('ano_lectivo')}}</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    {{Form::label('turma', "Turma")}} <span class="text-danger">*</span>
                                                    {{Form::select('turma', $getTurmas, null, ['class'=>"form-control", 'placeholder'=>"Turmas"])}}
                                                    <div class="erro">
                                                        @if($errors->has('turma'))
                                                        <div class="text-danger">{{$errors->first('turma')}}</div>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>


                                            <br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    {{Form::submit('Baixar', ['class'=>"btn btn-primary"])}}
                                                 </div>

                                            </div>

                                        {{Form::close()}}
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
            <a href="/offline_online/list" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i
                    class="ti-arrow-left"></i></a>
        </div>
    </div>
@endsection

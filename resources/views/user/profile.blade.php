@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}</h5>
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
                    <div class="col-lg-12 col-xl-12 tab-with-img">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs img-tabs b-none" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home8" role="tab">
                                   <img src="
                                   @if ($getPessoa->foto)
                                    {{asset($getPessoa->foto)}}
                                   @else
                                   {{asset('assets/template/images/profile.png')}}
                                   @endif
                                   " class="img-fluid img-circle" alt="">
                                <span class="quote"><i class="icofont icofont-quote-left bg-primary"></i></span>
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content card-block">
                            <div class="tab-pane active" id="home8" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(session('error'))
                                        <div class="alert alert-danger">{{session('error')}}</div>
                                        @endif

                                        @if(session('success'))
                                        <div class="alert alert-success">{{session('success')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-8">

                                        <div class="form">
                                            {{Form::open([])}}
                                            @csrf
                                            <fieldset>
                                            <legend><i class="ti-list"></i> Palavra Passe</legend>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    {{Form::label('nome', "Nome completo")}} <span class="text-danger">*</span>
                                                    {{Form::text('nome', null, ['class'=>"form-control", 'placeholder'=>"Nome completo"])}}
                                                    <div class="erro">
                                                        @if($errors->has('nome'))
                                                        <div class="text-danger">{{$errors->first('nome')}}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            </fieldset>
                                            {{Form::close()}}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <fieldset>
                                            <legend>Perfil</legend>
                                            <span class="title">Nome</span>: {{$getPessoa->nome}}<br/>
                                            <span class="title">Data de Nascimento</span>: {{date('d-m-Y', strtotime($getPessoa->data_nascimento))}}<br/>
                                            <span class="title">Nº B.I.</span>: {{$getPessoa->bilhete}}<br/>
                                            <span class="title">Telf.</span>: {{$getPessoa->telefone}}<br/>
                                        </fieldset>
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
		<a href="#" class="btn btn-primary btnCircular btnPrincipal" title="Novo"><i class="ti-plus"></i></a>
	</div>
</div>


@endsection

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
                   <div class="formulario">
                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif

                    {{Form::open(['method'=>"post", 'url'=>"/funcionarios/import/store", 'enctype'=>"multipart/form-data"])}}
                    @csrf
                    <fieldset>
                        <legend><i class="ti-list"></i> Dados</legend>
                        <div class="row">
                            <div class="col-md-5">
                                {{Form::label('arquivo', "Arquivo (.xls, .xlsx)")}} <span class="text-danger">*</span>
                                {{Form::file('arquivo', null, ['class'=>"form-control", 'placeholder'=>"Arquivo"])}}
                            <div class="erro">
                                @if($errors->has('arquivo'))
                                <div class="text-danger">{{$errors->first('arquivo')}}</div>
                                @endif
                            </div>
                            </div>

                        </div>

                    </fieldset>
                    <br/>
                        <div class="row">
                            <div class="col-md-4">
                                {{Form::submit('Salvar', ['class'=>"btn btn-primary"])}}
                            </div>
                        </div>

                    {{Form::close()}}

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
		<a href="/funcionarios/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

@endsection

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
                        {{Form::open(['method'=>"post", 'url'=>"/institucional/cursos/store"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados do curso</legend>
                            <div class="row">
                                <div class="col-md-4">
                                    {{Form::label('ensino', "Ensino")}} <span class="text-danger">*</span>
                                    {{Form::select('ensino', $getEnsinos, null, ['class'=>"form-control", 'placeholder'=>"Ensino"])}}
                                <div class="erro">
                                    @if($errors->has('ensino'))
                                    <div class="text-danger">{{$errors->first('ensino')}}</div>
                                    @endif 
                                </div>
                                </div>

                                <div class="col-md-5">
                                    {{Form::label('curso', "Nome do curso")}} <span class="text-danger">*</span>
                                    {{Form::text('curso', null, ['class'=>"form-control", 'placeholder'=>"Curso"])}}
                                    <div class="erro">
                                        @if($errors->has('curso'))
                                        <div class="text-danger">{{$errors->first('curso')}}</div>
                                        @endif 
                                    </div>
                                </div>
                            </div>
                            <br/>
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
		<a href="/institucional/cursos/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>


@endsection
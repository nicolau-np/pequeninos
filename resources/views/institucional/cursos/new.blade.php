@extends('layouts.app')
@section('content')
<style>
 /* Botão pesquisar e Mais Botões */
.btnPesquisar{
	position: fixed;
	float: bottom;
	bottom: 15px;
	right: 15px;
	z-index: 100;
}


.btnPesquisarBtn {
	display: inline-block;
}

.btnCircular{
	border-radius: 50%;
    
}

.btnPrincipal{
	font-size: 20px;
	padding: 12px;
    text-align: center;
    font-weight: bold;
    box-shadow: 2px 4px 47px -4px rgba(0,0,0,0.82);
}

.btnPrincipal:hover{
	background-color: #4680ff;
    border:0px;
}

fieldset{
    border: 1px solid #4680ff;
    padding: 10px;
    box-shadow: 0 1px 11px 0 rgba(0, 0, 0, 0.12);
}

fieldset legend{
    padding: 10px;
    background:#4680ff;
    color: #fff;
    font-size: 14px;
    margin-left: 2%;
    width: 30%;
    box-shadow: 0 1px 11px 0 rgba(0, 0, 0, 0.12);
    border-radius: 4px;
}
.erro{
    font-size: 12px;
}
</style>
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
                                    {{Form::label('ensino', "Ensino")}}
                                    {{Form::select('ensino', $getCursos, null, ['class'=>"form-control", 'placeholder'=>"Ensino"])}}
                                <div class="erro">
                                    @if($errors->has('ensino'))
                                    <div class="text-danger">{{$errors->first('ensino')}}</div>
                                    @endif 
                                </div>
                                </div>

                                <div class="col-md-5">
                                    {{Form::label('curso', "Nome do curso")}}
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
		<a href="/institucional/cursos/" class="btn btn-success btnCircular btnPrincipal" title="Novo"><i class="ti-search"></i></a>
	</div>
</div>


@endsection
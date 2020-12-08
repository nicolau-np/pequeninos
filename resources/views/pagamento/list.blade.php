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
                   <div class="row">
                       <div class="col-md-12">
                        @if(session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
                       </div>
               
                    <div class="col-md-8">
                        <div class="row">
                            @if ($getTabelaPreco->count()==0)
                                Não encontrou Tipos de Pagamentos
                            @else
                            @foreach ($getTabelaPreco as $tabela_preco)
                            <div class="col-md-6 col-xl-6">
                                <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="icofont icofont-money bg-c-blue card1-icon"></i>
                                    <span class="text-c-pink f-w-600">Revenue</span>
                                    <h4>$23,589</h4>
                                    <div>
                                        <span class="f-left m-t-10 text-muted">
                                            <i class="text-c-pink f-16 icofont icofont-calendar m-r-10"></i>Last 24 hours
                                        </span>
                                    </div>
                                </div>
                                </div>
                                </div>
                            @endforeach
                            @endif
                            
                         
                        </div>
                      
                    </div>

                    <div class="col-md-4">
                       <fieldset>
                            <legend style="width:90%;"><b><i class="ti-user"></i> {{$getHistoricoEstudante->estudante->pessoa->nome}}</b></legend>
                            {{Form::open(['method'=>"get", 'url'=>"/pagamentos/list"])}}
                            <div class="row">
                               
                                <div class="col-md-7">
                                    {{Form::hidden('id_estudante', $getHistoricoEstudante->id_estudante, []) }}
                                    {{Form::select('ano_lectivo', $getAnos, $getAno->id, 
                                    ['class'=>"form-control", 'placeholder'=>"Ano Lectivo"])}}
                                </div>
                                <div class="col-md-3">
                                    {{Form::submit('Pesquisar', ['class'=>"btn btn-primary btn-sm"])}}
                                </div>
                               
                            </div>
                            {{Form::close()}}
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                     <p>Turma: {{$getHistoricoEstudante->turma->turma}}</p>
                            <p>Curso: {{$getHistoricoEstudante->turma->curso->curso}}</p>
                            <p>Classe: {{$getHistoricoEstudante->turma->classe->classe}}</p>
                            <p>Ano de Confirmação: {{$getHistoricoEstudante->ano_lectivo}}</p>
                                </div>
                            </div>
                           
                        </fieldset>
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
		<a href="/estudantes/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>


@endsection
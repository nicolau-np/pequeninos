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
                         <div class="col-md-12">
                            @if(session('success'))
                            <div class="alert alert-danger">{{session('success')}}</div>
                            @endif
                        </div>
                
                     <div class="col-md-8">
                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home3" role="tab" aria-expanded="true">À Pagar</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profile3" role="tab" aria-expanded="false">Pagos</a>
                                    <div class="slide"></div>
                                </li>
                              
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content card-block">
                                <div class="tab-pane active" id="home3" role="tabpanel" aria-expanded="true">
                                    <p class="m-0">
                                        Meses Á Pagar
                                    </p>
                                </div>
                                <div class="tab-pane" id="profile3" role="tabpanel" aria-expanded="false">
                                    <p class="m-0">
                                        @if ($getPagos->count()==0)
                                            Nenhum pago 
                                        @else  
                                        <ul>
                                            @foreach ($getPagos as $pagos)
                                                <li>{{$pagos->epoca}}</li>
                                            @endforeach
                                        </ul>
                                        @endif
                                   </div>
                                </div>
                        
                     </div>
 
                     <div class="col-md-4">
                        <fieldset>
                             <legend style="width:90%;"><b><i class="ti-user"></i> {{$getHistoricoEstudante->estudante->pessoa->nome}}</b></legend>
                             
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
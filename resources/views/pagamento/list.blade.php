@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}
                    <i class="ti-angle-right"></i>
                        @foreach ($getHistoricosEstudantes as $historicos)
                    <a href="/pagamentos/listar/{{$historicos->id_estudante}}/{{$historicos->ano_lectivo}}" style="color:#4680ff;">{{$historicos->ano_lectivo}}</a>
                    <i class="ti-angle-right"></i>
                    @endforeach
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
                       </div>

                    <div class="col-md-8">
                        <div class="row">
                            @if ($getTabelaPreco->count()==0)
                            <div class="col-md-6 col-xl-6">
                            Não encontrou Tipos de Pagamentos
                            </div>
                            @else
                            @foreach ($getTabelaPreco as $tabela_preco)

                            <div class="col-md-6 col-xl-6">
                            <a href="/pagamentos/create/{{$tabela_preco->tipo_pagamento->id}}" style="text-decoration: none;">
                                <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="icofont icofont-money bg-c-blue card1-icon"></i>
                                <span class="text-c-pink f-w-600" style="font-size:13px;">{{$tabela_preco->tipo_pagamento->tipo}}</span>
                                    <h4 style="font-size:17px;">{{number_format($tabela_preco->preco,2,',','.')}} Akz</h4>
                                    <div>
                                        <span class="f-left m-t-10 text-muted">
                                            <i class="text-c-pink f-16 icofont icofont-calendar m-r-10"></i>{{$tabela_preco->forma_pagamento}}
                                        </span>
                                    </div>
                                </div>
                                </div>
                                </a>
                                </div>

                            @endforeach
                            @endif


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

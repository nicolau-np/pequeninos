@extends('layouts.app')
@section('content')
<style>
    .title{
        font-weight: bold;
    }
</style>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}} &nbsp;&nbsp;&nbsp;
                        @foreach ($getHistoricoEstudanteAnos as $historicos_anos)
                    <a href="/estudantes/ficha/{{$historicos_anos->id_estudante}}/{{$historicos_anos->ano_lectivo}}" style="color:#4680ff;">{{$historicos_anos->ano_lectivo}}</a>
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
                        <fieldset>
                            <legend style="width:70%;"><b><i class="ti-user"></i> Dados Pessoais</b></legend>

                            <div class="row">
                                <div class="col-md-12">
                                    <span class="title">Nome Completo:</span> {{$getHistoricoEstudante->estudante->pessoa->nome}}<br/>
                                    <span class="title">Gênero:</span> {{$getHistoricoEstudante->estudante->pessoa->genero}}<br/>
                                    <span class="title">Data de Nascimento:</span> {{$getHistoricoEstudante->estudante->pessoa->data_nascimento}}<br/>
                                    <span class="title">Estado Civíl:</span> {{$getHistoricoEstudante->estudante->pessoa->estado_civil}}<br/>
                                    <span class="title">Naturalidade:</span> {{$getHistoricoEstudante->estudante->pessoa->naturalidade}}<br/>
                                    <span class="title">Telefone:</span> {{$getHistoricoEstudante->estudante->pessoa->telefone}}<br/>
                                    <span class="title">Nº do Bilhete:</span> {{$getHistoricoEstudante->estudante->pessoa->bilhete}}<br/>
                                    <span class="title">Data de Emissão:</span> {{$getHistoricoEstudante->estudante->pessoa->data_emissao}}<br/>
                                    <span class="title">Local de Emissão:</span> {{$getHistoricoEstudante->estudante->pessoa->local_emissao}}<br/>
                                    <span class="title">Pai:</span> {{$getHistoricoEstudante->estudante->pessoa->pai}}<br/>
                                    <span class="title">Mãe:</span> {{$getHistoricoEstudante->estudante->pessoa->mae}}<br/>
                                    <span class="title">Comuna:</span> {{$getHistoricoEstudante->estudante->pessoa->comuna}}<br/>
                                </div>
                            </div>

                        </fieldset>
                    </div>

                    <div class="col-md-4">
                       <fieldset>
                            <legend style="width:90%;"><b><i class="ti-settings"></i> Operações</b></legend>

                            <div class="row">

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

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
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">FICHAS ESTUDANTE </h5>
                            </div>
                            <div class="card-block accordion-block color-accordion-block">
                                <div class="color-accordion" id="color-accordion">

                                    <a class="accordion-msg b-none">Dados Pessoais</a>
                                    <div class="accordion-desc">
                                        <div class="data">

                                        </div>
                                    </div>

                                    <a class="accordion-msg bg-dark-primary b-none">Dados Acadêmicos</a>                                        2</a>
                                        <div class="accordion-desc">
                                            <div class="data">

                                            </div>
                                        </div>
                                        <a class="accordion-msg bg-darkest-primary b-none">Extra</a>
                                            <div class="accordion-desc">
                                                <div class="data">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

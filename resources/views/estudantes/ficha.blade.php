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

                            <div class="row">


                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-header-text">COLOR ACCORDION</h5>
                                        </div>
                                        <div class="card-block accordion-block color-accordion-block">
                                            <div class="color-accordion ui-accordion ui-widget ui-helper-reset" id="color-accordion" role="tablist">
                                                <a class="accordion-msg b-none ui-accordion-header ui-corner-top ui-state-default ui-accordion-header-active ui-state-active ui-accordion-icons scale_active" role="tab" id="ui-id-13" aria-controls="ui-id-14" aria-selected="true" aria-expanded="true" tabindex="0"><span class="ui-accordion-header-icon ui-icon zmdi zmdi-chevron-up"></span>Lorem Message 1</a>
                                                <div class="accordion-desc ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content ui-accordion-content-active" style="" id="ui-id-14" aria-labelledby="ui-id-13" role="tabpanel" aria-hidden="false">
                                                    <p>
                                                        Lorem Ipsum is simply dummy text of the printing and
                                                        typesetting industry. Lorem Ipsum has been the
                                                        industry's standard dummy text ever since the 1500s,
                                                        when an unknown printer took a galley of type and
                                                        scrambled it to make a type specimen book. It has
                                                        survived not only five centuries, but also the leap into
                                                        electronic typesetting, remaining essentially unchanged.
                                                        It was popularised in the 1960s with the release of
                                                        Letraset sheets containing Lorem Ipsum passages, and
                                                        more .
                                                    </p>
                                                </div>
                                                <a class="accordion-msg bg-dark-primary b-none ui-accordion-header ui-corner-top ui-accordion-header-collapsed ui-corner-all ui-state-default ui-accordion-icons scale_active" role="tab" id="ui-id-15" aria-controls="ui-id-16" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon zmdi zmdi-chevron-down"></span>Lorem Message
                                                    2</a>
                                                    <div class="accordion-desc ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content" style="display: none;" id="ui-id-16" aria-labelledby="ui-id-15" role="tabpanel" aria-hidden="true">
                                                        <p>
                                                            Lorem Ipsum is simply dummy text of the printing and
                                                            typesetting industry. Lorem Ipsum has been the
                                                            industry's standard dummy text ever since the 1500s,
                                                            when an unknown printer took a galley of type and
                                                            scrambled it to make a type specimen book. It has
                                                            survived not only five centuries, but also the leap into
                                                            electronic typesetting, remaining essentially unchanged.
                                                            It was popularised in the 1960s with the release of
                                                            Letraset sheets containing Lorem Ipsum passages, and
                                                            more .
                                                        </p>
                                                    </div>
                                                    <a class="accordion-msg bg-darkest-primary b-none ui-accordion-header ui-corner-top ui-accordion-header-collapsed ui-corner-all ui-state-default ui-accordion-icons scale_active" role="tab" id="ui-id-17" aria-controls="ui-id-18" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon zmdi zmdi-chevron-down"></span>Lorem Message
                                                        3</a>
                                                        <div class="accordion-desc ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content" style="display: none;" id="ui-id-18" aria-labelledby="ui-id-17" role="tabpanel" aria-hidden="true">
                                                            <p>
                                                                Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the
                                                                industry's standard dummy text ever since the 1500s,
                                                                when an unknown printer took a galley of type and
                                                                scrambled it to make a type specimen book. It has
                                                                survived not only five centuries, but also the leap into
                                                                electronic typesetting, remaining essentially unchanged.
                                                                It was popularised in the 1960s with the release of
                                                                Letraset sheets containing Lorem Ipsum passages, and
                                                                more .
                                                            </p>
                                                        </div>
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

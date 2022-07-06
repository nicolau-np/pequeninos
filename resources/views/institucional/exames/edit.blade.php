@extends('layouts.app')
@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $submenu }}</h5>
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
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            {{ Form::open(['method' => 'put', 'url' => "/institucional/exames/update/$getCadeiraExame->id"]) }}
                            @csrf
                            <fieldset>
                                <legend><i class="ti-list"></i> Dados do preço</legend>
                                <div class="row">

                                    <div class="col-md-4">
                                        {{ Form::label('curso', 'Curso') }} <span class="text-danger">*</span>
                                        {{ Form::text('curso', $getCadeiraExame->curso->curso, ['class' => 'form-control', 'placeholder' => 'Curso']) }}
                                        <div class="erro">
                                            @if ($errors->has('curso'))
                                                <div class="text-danger">{{ $errors->first('curso') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('classe', 'Classe') }} <span class="text-danger">*</span>

                                        {{ Form::text('classe', $getCadeiraExame->classe->classe, ['class' => 'form-control', 'placeholder' => 'Classe']) }}

                                        <div class="erro">
                                            @if ($errors->has('classe'))
                                                <div class="text-danger">{{ $errors->first('classe') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        {{ Form::label('disciplina', 'Disciplina') }} <span class="text-danger">*</span>
                                        {{ Form::text('disciplina', $getCadeiraExame->disciplina->disciplina, ['class' => 'form-control', 'placeholder' => 'Disciplina']) }}
                                        <div class="erro">
                                            @if ($errors->has('disciplinas'))
                                                <div class="text-danger">{{ $errors->first('disciplinas') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-3">
                                        {{ Form::label('exame_oral', 'Exame Oral') }} <span class="text-danger">*</span>
                                        {{ Form::select('exame_oral',[
                                                        'sim' => 'sim',
                                                        'não' => 'não',
                                                    ],$getCadeiraExame->exame_oral,['class' => 'form-control', 'placeholder' => 'Exame Oral']) }}
                                        <div class="erro">
                                            @if ($errors->has('exame_oral'))
                                                <div class="text-danger">{{ $errors->first('exame_oral') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br />
                            </fieldset>
                            <br />
                            <div class="row">
                                <div class="col-md-4">
                                    {{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
                                </div>

                            </div>



                            {{ Form::close() }}
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
            <a href="/institucional/exames/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i
                    class="ti-search"></i></a>
        </div>
    </div>

@endsection

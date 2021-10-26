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
                            {{ Form::open(['method' => 'put', 'url' => "/estudantes/update/{$getEstudante->id}", 'enctype' => 'multipart/form-data']) }}
                            @csrf
                            <fieldset>
                                <legend><i class="ti-list"></i> Dados pessoais</legend>
                                <div class="row">

                                    <div class="col-md-4">
                                        {{ Form::label('nome', 'Nome completo') }} <span class="text-danger">*</span>
                                        {{ Form::text('nome', $getEstudante->pessoa->nome, ['class' => 'form-control', 'placeholder' => 'Nome completo']) }}
                                        <div class="erro">
                                            @if ($errors->has('nome'))
                                                <div class="text-danger">{{ $errors->first('nome') }}</div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        {{ Form::label('genero', 'Gênero') }} <span class="text-danger">*</span>
                                        {{ Form::select(
    'genero',
    [
        'M' => 'M',
        'F' => 'F',
    ],
    $getEstudante->pessoa->genero,
    ['class' => 'form-control', 'placeholder' => 'Gênero'],
) }}

                                        <div class="erro">
                                            @if ($errors->has('genero'))
                                                <div class="text-danger">{{ $errors->first('genero') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('provincia', 'Provincia') }} <span class="text-danger">*</span>
                                        {{ Form::select('provincia', $getProvincias, $getEstudante->pessoa->municipio->provincia->id, ['class' => 'form-control provincia', 'placeholder' => 'Província']) }}

                                        <div class="erro">
                                            @if ($errors->has('provincia'))
                                                <div class="text-danger">{{ $errors->first('provincia') }}</div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        {{ Form::label('municipio', 'Município') }} <span class="text-danger">*</span>
                                        <span class="load_municipios">
                                            {{ Form::select(
    'municipio',
    [
        $getEstudante->pessoa->municipio->id => $getEstudante->pessoa->municipio->municipio,
    ],
    $getEstudante->pessoa->municipio->id,
    ['class' => 'form-control', 'placeholder' => 'Município'],
) }}
                                        </span>
                                        <div class="erro">
                                            @if ($errors->has('municipio'))
                                                <div class="text-danger">{{ $errors->first('municipio') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        {{ Form::label('foto', 'FotoGrafia') }}
                                        {{ Form::file('foto', null, ['class' => 'form-control', 'placeholder' => 'FotoGrafia']) }}
                                        <div class="erro">
                                            @if ($errors->has('foto'))
                                                <div class="text-danger">{{ $errors->first('foto') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        {{ Form::label('naturalidade', 'Naturalidade') }}
                                        {{ Form::text('naturalidade', $getEstudante->pessoa->naturalidade, ['class' => 'form-control', 'placeholder' => 'Naturalidade']) }}
                                        <div class="erro">
                                            @if ($errors->has('naturalidade'))
                                                <div class="text-danger">{{ $errors->first('naturalidade') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('comuna', 'Comuna') }}
                                        {{ Form::text('comuna', $getEstudante->pessoa->comuna, ['class' => 'form-control', 'placeholder' => 'Comuna']) }}
                                        <div class="erro">
                                            @if ($errors->has('comuna'))
                                                <div class="text-danger">{{ $errors->first('comuna') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('residencia', 'Residencia') }}
                                        {{ Form::text('residencia', $getEstudante->pessoa->residencia, ['class' => 'form-control', 'form-control', 'placeholder' => 'Residencia']) }}
                                        <div class="erro">
                                            @if ($errors->has('residencia'))
                                                <div class="text-danger">{{ $errors->first('residencia') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('rua', 'Rua') }}
                                        {{ Form::text('rua', $getEstudante->pessoa->rua, ['class' => 'form-control', 'form-control', 'placeholder' => 'Rua']) }}
                                        <div class="erro">
                                            @if ($errors->has('rua'))
                                                <div class="text-danger">{{ $errors->first('rua') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('bairro', 'Bairro') }}
                                        {{ Form::text('bairro', $getEstudante->pessoa->bairro, ['class' => 'form-control', 'form-control', 'placeholder' => 'Bairro']) }}
                                        <div class="erro">
                                            @if ($errors->has('bairro'))
                                                <div class="text-danger">{{ $errors->first('bairro') }}</div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        {{ Form::label('data_nascimento', 'Data de Nascimento') }} <span
                                            class="text-danger">*</span>
                                        {{ Form::date('data_nascimento', $getEstudante->pessoa->data_nascimento, ['class' => 'form-control', 'placeholder' => 'Data de Nascimento']) }}
                                        <div class="erro">
                                            @if ($errors->has('data_nascimento'))
                                                <div class="text-danger">{{ $errors->first('data_nascimento') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        {{ Form::label('deficiencia', 'Tem necessidades de atenção especial?') }}
                                        {{ Form::select(
    'deficiencia',
    [
        'nao' => 'nao',
        'sim' => 'sim',
    ],
    $getEstudante->pessoa->deficiencia,
    ['class' => 'form-control', 'placeholder' => 'Tem necessidades de atenção especial?'],
) }}

                                        <div class="erro">
                                            @if ($errors->has('deficiencia'))
                                                <div class="text-danger">{{ $errors->first('deficiencia') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('tipo_deficiencia', 'Porque?') }}
                                        {{ Form::text('tipo_deficiencia', $getEstudante->pessoa->tipo_deficiencia, ['class' => 'form-control', 'placeholder' => 'Porque?']) }}
                                        <div class="erro">
                                            @if ($errors->has('tipo_deficiencia'))
                                                <div class="text-danger">{{ $errors->first('tipo_deficiencia') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('estado_civil', 'Estado Civíl') }}
                                        {{ Form::select(
    'estado_civil',
    [
        'Solteiro(a)' => 'Solteiro(a)',
        'Casado(a)' => 'Casado(a)',
    ],
    $getEstudante->pessoa->estado_civil,
    ['class' => 'form-control', 'placeholder' => 'Estado Civíl'],
) }}

                                        <div class="erro">
                                            @if ($errors->has('estado_civil'))
                                                <div class="text-danger">{{ $errors->first('estado_civil') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('telefone', 'Telefone') }}
                                        {{ Form::number('telefone', $getEstudante->pessoa->telefone, ['class' => 'form-control', 'placeholder' => 'Telefone']) }}
                                        <div class="erro">
                                            @if ($errors->has('telefone'))
                                                <div class="text-danger">{{ $errors->first('telefone') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('bilhete', 'Bilhete') }}
                                        {{ Form::text('bilhete', $getEstudante->pessoa->bilhete, ['class' => 'form-control', 'placeholder' => 'Bilhete']) }}
                                        <div class="erro">
                                            @if ($errors->has('bilhete'))
                                                <div class="text-danger">{{ $errors->first('bilhete') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('local_emissao', 'Local de Emissão') }}
                                        {{ Form::text('local_emissao', $getEstudante->pessoa->local_emissao, ['class' => 'form-control', 'placeholder' => 'Local de Emissão']) }}
                                        <div class="erro">
                                            @if ($errors->has('local_emissao'))
                                                <div class="text-danger">{{ $errors->first('local_emissao') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('data_emissao', 'Data de Emissão') }}
                                        {{ Form::date('data_emissao', $getEstudante->pessoa->data_emissao, ['class' => 'form-control', 'placeholder' => 'Data de Emissão']) }}
                                        <div class="erro">
                                            @if ($errors->has('data_emissao'))
                                                <div class="text-danger">{{ $errors->first('data_emissao') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('pai', 'Pai') }}
                                        {{ Form::text('pai', $getEstudante->pessoa->pai, ['class' => 'form-control', 'placeholder' => 'Pai']) }}
                                        <div class="erro">
                                            @if ($errors->has('pai'))
                                                <div class="text-danger">{{ $errors->first('pai') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('mae', 'Mãe') }}
                                        {{ Form::text('mae', $getEstudante->pessoa->mae, ['class' => 'form-control', 'placeholder' => 'Mãe']) }}
                                        <div class="erro">
                                            @if ($errors->has('mae'))
                                                <div class="text-danger">{{ $errors->first('mae') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        {{ Form::text('encarregador', null, ['class' => 'form-control encarregador', 'placeholder' => 'Encarregado']) }}
                                    </div>
                                    <div class="col-md-12">
                                        <span class="load_encarregados">
                                            <input type="radio" name="encarregado" id="encarregado"
                                                value="{{ $getEstudante->id_encarregado }}" checked />
                                            {{ $getEstudante->encarregado->pessoa->nome }}
                                        </span>
                                        <div class="erro">
                                            @if ($errors->has('encarregado'))
                                                <div class="text-danger">{{ $errors->first('encarregado') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <br />
                            <fieldset>
                                <legend><i class="ti-list"></i> Dados acadêmicos</legend>
                                <div class="row">
                                    <div class="col-md-3">
                                        {{ Form::label('categoria', 'Categoria') }}
                                        {{ Form::select('categoria', $getCategorias, $getEstudante->categoria, ['class' => 'form-control', 'placeholder' => 'Categoria']) }}
                                        <div class="erro">
                                            @if ($errors->has('categoria'))
                                                <div class="text-danger">{{ $errors->first('categoria') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('curso', 'Curso') }} <span class="text-danger">*</span>
                                        {{ Form::select('curso', $getCursos, $getEstudante->turma->id_curso, ['class' => 'form-control curso', 'placeholder' => 'Curso']) }}
                                        <div class="erro">
                                            @if ($errors->has('curso'))
                                                <div class="text-danger">{{ $errors->first('curso') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('classe', 'Classe') }} <span class="text-danger">*</span>
                                        <span class="load_classes">
                                            {{ Form::select(
    'classe',
    [
        $getEstudante->turma->id_classe => $getEstudante->turma->classe->classe,
    ],
    $getEstudante->turma->id_classe,
    ['class' => 'form-control classe', 'placeholder' => 'Classe'],
) }}
                                        </span>
                                        <div class="erro">
                                            @if ($errors->has('classe'))
                                                <div class="text-danger">{{ $errors->first('classe') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('turma', 'Turma') }} <span class="text-danger">*</span>
                                        <span class="load_turmas">
                                            {{ Form::select(
    'turma',
    [
        $getEstudante->id_turma => $getEstudante->turma->turma,
    ],
    $getEstudante->id_turma,
    ['class' => 'form-control', 'placeholder' => 'Turma'],
) }}
                                        </span>
                                        <div class="erro">
                                            @if ($errors->has('turma'))
                                                <div class="text-danger">{{ $errors->first('turma') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{ Form::label('docs_entregues', 'Docs Entregues') }} <span
                                            class="text-danger">*</span><br />
                                        @foreach ($getDocsEntregues as $docs)
                                            @if ($docs->documento == "Cédula ou B.I")
                                            <input type="checkbox" name="docs_entregues[]" value="Cédula ou B.I" checked /> Cédula
                                            ou B.I
                                            &nbsp;&nbsp;
                                            @endif

                                            @if ($docs->documento == "Atestado Médico")
                                            <input type="checkbox" name="docs_entregues[]" value="Atestado Médico" checked />
                                            Atestado Médico
                                            &nbsp;&nbsp;
                                            @endif

                                            @if ($docs->documento == "4 Fotografias")
                                            <input type="checkbox" name="docs_entregues[]" value="4 Fotografias" /> 4
                                            Fotografias
                                            @endif
                                        @endforeach

                                        <div class="erro">
                                            @if ($errors->has('docs_entregues'))
                                                <div class="text-danger">{{ $errors->first('docs_entregues') }}</div>
                                            @endif
                                        </div>
                                        <br />
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label('ano_lectivo', 'Ano Lectivo') }} <span class="text-danger">*</span>
                                        {{ Form::select('ano_lectivo', $getAnoLectivo, $getAno->ano_lectivo, ['class' => 'form-control', 'placeholder' => 'Ano Lectivo']) }}

                                        <div class="erro">
                                            @if ($errors->has('ano_lectivo'))
                                                <div class="text-danger">{{ $errors->first('ano_lectivo') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

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
            <a href="/estudantes/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i
                    class="ti-search"></i></a>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.provincia').change(function(e) {
                e.preventDefault();
                var data = {
                    id_provincia: $(this).val(),
                    _token: "{{ csrf_token() }}"
                };
                $.ajax({
                    type: "post",
                    url: "{{ route('getMunicipios') }}",
                    data: data,
                    dataType: "html",
                    success: function(response) {
                        $('.load_municipios').html(response);
                    }
                });
            });

            $('.curso').change(function(e) {
                e.preventDefault();
                var data = {
                    id_curso: $(this).val(),
                    _token: "{{ csrf_token() }}"
                };
                $.ajax({
                    type: "post",
                    url: "{{ route('getClasses') }}",
                    data: data,
                    dataType: "html",
                    success: function(response) {
                        $('.load_classes').html(response);
                    }
                });
            });

            $('.encarregador').keyup(function() {
                var data = {
                    search_text: $(this).val(),
                    _token: "{{ csrf_token() }}"
                };
                $.ajax({
                    type: "post",
                    url: "{{ route('getEncarregados') }}",
                    data: data,
                    dataType: "html",
                    success: function(response) {
                        $('.load_encarregados').html(response);
                    }
                });
            });

        });

    </script>
@endsection

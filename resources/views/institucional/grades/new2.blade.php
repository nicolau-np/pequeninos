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
                            {{ Form::open(['method' => 'post', 'url' => '/institucional/grades/store']) }}
                            @csrf
                            <fieldset>
                                <legend><i class="ti-list"></i> Dados da Grade Curricular</legend>
                                <div class="row mb-3">

                                    <div class="col-md-4">
                                        {{ Form::label('curso', 'Curso') }} <span class="text-danger">*</span>
                                        {{ Form::select('curso', $getCursos, null, ['class' => 'form-control curso', 'placeholder' => 'Curso']) }}
                                        <div class="erro">
                                            @if ($errors->has('curso'))
                                                <div class="text-danger">{{ $errors->first('curso') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        {{ Form::label('classe', 'Classe') }} <span class="text-danger">*</span>
                                        <span class="load_classes">
                                            {{ Form::select('classe', [], null, ['class' => 'form-control', 'placeholder' => 'Classe']) }}
                                        </span>
                                        <div class="erro">
                                            @if ($errors->has('classe'))
                                                <div class="text-danger">{{ $errors->first('classe') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        {{ Form::label('epoca', 'Epoca') }} <span class="text-danger">*</span>
                                        {{ Form::select(
    'epoca',
    [
        'Anual' => 'Anual',
        'Semestral' => 'Semestral',
    ],
    null,
    ['class' => 'form-control', 'placeholder' => 'Epoca'],
) }}
                                        <div class="erro">
                                            @if ($errors->has('epoca'))
                                                <div class="text-danger">{{ $errors->first('epoca') }}</div>
                                            @endif
                                        </div>
                                    </div>


                                </div>
                                <hr>
                                <div class="row" id="disciplinas_rows">


                                    @foreach (array_keys(old('disciplinas', [])) as $index)


                                        <div id="disciplina_row_{{ $index }}" class="row col-12">
                                            <div class="col-md-6">

                                                {{ Form::label('disciplinas_id_' . $index, 'Disciplina #' . $index) }}
                                                <select id="disciplinas_id_{{ $index }}"
                                                    name="disciplinas[{{ $index }}][id]" class="form-control">
                                                    <option value="" hidden>Selecione a Disciplina</option>
                                                    @foreach ($getDisciplinas as $disciplina)
                                                        <option value="{{ $disciplina->id }}"
                                                            {{ old('disciplinas')[$index]['id'] == $disciplina->id ? 'selected' : '' }}>
                                                            {{ $disciplina->disciplina }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-4">
                                                {{ Form::label('disciplinas_nuclear_' . $index, 'É Nuclear?') }}
                                                <select id="disciplinas_nuclear_{{ $index }}"
                                                    name="disciplinas[{{ $index }}][is_nuclear]"
                                                    class="form-control">

                                                    <option value="1"
                                                        {{ (old('disciplinas', [])[$index]['is_nuclear'] ?? null) == 1 ? 'selected' : '' }}>
                                                        Sim
                                                    </option>
                                                    <option value="0"
                                                        {{ (old('disciplinas', [])[$index]['is_nuclear'] ?? null) == 0 ? 'selected' : '' }}>
                                                        Não
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 form-group">
                                                <label>&nbsp;</label>
                                                <br>
                                                <a href="#" class="btn btn-danger btn-sm"
                                                    onclick="$('#disciplina_row_{{ $index }}').remove();">
                                                    <i class="ti-trash"></i>
                                                    &nbsp;Eliminar
                                                </a>
                                            </div>

                                        </div>


                                    @endforeach


                                </div>


                                <div class="row">

                                    <div class="col-md-12 mb-5">
                                        <a href="#disciplinas_rows" id="btnAdDisciplina" class="btn btn-primary btn-block">
                                            <i class="ti-plus"></i>
                                            &nbsp;Adicionar Disciplina
                                        </a>
                                    </div>

                                    <div class="col-md-12">
                                        {{ Form::submit('Salvar', ['class' => 'btn btn-success btn-block']) }}



                                    </div>

                                </div>
                                <br />
                            </fieldset>



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
            <a href="/institucional/grades/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i
                    class="ti-search"></i></a>
        </div>
    </div>
    <script>
        //var DISCIPLINAS = JSON.parse(JSON.stringify('{{ $getDisciplinas->toJson() }}'));



        $(document).ready(function() {



            $('#btnAdDisciplina').click(function(e) {
                e.preventDefault();

                let row = $('div[id*="disciplina_row"]').length + 1;

                document.getElementById('disciplinas_rows').innerHTML += `<div id="disciplina_row_` + row + `" class="row col-12">
                                            <div class="col-md-6">

                                                <label for="disciplinas_id_` + row + `">Disciplina #` + row + `</label>
                                                <select id="disciplinas_id_` + row + `" name="disciplinas[` + row + `][id]" class="form-control">
                                                    <option value="" hidden>Selecione a Disciplina</option>
                                                    @foreach ($getDisciplinas as $disciplina)
                                                        <option value="{{ $disciplina->id }}">
                                                            {{ $disciplina->disciplina }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-4">
                                                <label for="disciplinas_nuclear_` + row + `">É Nuclear?</label>
                                                <select id="disciplinas_nuclear_` + row + `" name="disciplinas[` + row + `][is_nuclear]"
                                                    class="form-control">

                                                    <option value="1">
                                                        Sim
                                                    </option>
                                                    <option value="0">
                                                        Não
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 form-group">
                                                <label>&nbsp;</label>
                                                <br>
                                                <a href="#" class="btn btn-danger btn-sm" onclick="$('#disciplina_row_` +
                    row + `').remove();">
                                                    <i class="ti-trash"></i>
                                                    &nbsp;Eliminar
                                                </a>
                                            </div>
                                        </div>`;


                $('#disciplinas_rows').prop('<div>', `<div id="disciplina_row_` + row + `" class="row col-12">
                                            <div class="col-md-6">

                                                <label for="disciplinas_id_` + row + `">Disciplina #` + row + `</label>
                                                <select id="disciplinas_id_` + row + `" name="disciplinas[id]" class="form-control">
                                                    <option value="" hidden>Selecione a Disciplina</option>
                                                    @foreach ($getDisciplinas as $disciplina)
                                                        <option value="{{ $disciplina->id }}">
                                                            {{ $disciplina->disciplina }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-4">
                                                <label for="disciplinas_nuclear_` + row + `">É Nuclear?</label>
                                                <select id="disciplinas_nuclear_` + row + `" name="disciplinas[is_nuclear]"
                                                    class="form-control">

                                                    <option value="1">
                                                        Sim
                                                    </option>
                                                    <option value="0">
                                                        Não
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 form-group">
                                                <label>&nbsp;</label>
                                                <br>
                                                <a href="#` + (row == 1 ? 'disciplinas_rows' : 'disciplina_row_' + (row -
                    1)) + `" class="btn btn-danger btn-sm" onclick="$('#disciplina_row_` + row + `').remove();">
                                                    <i class="ti-trash"></i>
                                                    &nbsp;Eliminar
                                                </a>
                                            </div>
                                        </div>`);


            });



            $('.curso').change(function(e) {
                e.preventDefault();
                var data = {
                    id_curso: $(this).val(),
                    _token: "{{ csrf_token() }}"
                }
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

        });

    </script>
@endsection

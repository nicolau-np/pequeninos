@php
use App\Http\Controllers\ControladorStatic;
@endphp
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
                        <div class="form">
                            {{ Form::open(['class' => 'form_search', 'method' => 'post', 'url' => '/estudantes/search_advanced']) }}
                            <div class="row">
                                <div class="col-md-8">

                                    {{ Form::text('processo', null, ['class' => 'form-control', 'placeholder' => 'Pesquisar pelo número de Processo']) }}
                                    <div class="erro">
                                        @if ($errors->has('processo'))
                                            <div class="text-danger">{{ $errors->first('processo') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-success btn-sm"><i class="ti-search"></i></button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>

                        @if ($getEstudante != 'nada')
                            @if ($getEstudante)
                                <div class="table-responsive">
                                    <br />
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nº PROC.</th>
                                                <th style="width:47px;">Foto</th>
                                                <th>Nome</th>
                                                <th>Curso</th>
                                                <th>Classe</th>
                                                <th>Turno</th>
                                                <th>Turma</th>
                                                <th>Ano de Confirmação</th>
                                                <th>Operações</th>
                                            </tr>
                                        </thead>
                                        <tbody class="load_estudantes">
                                            @if ($getEstudante->count() == 0)
                                                <span class="not_found">Nenhum resultado encontrado</span>
                                            @else

                                                <?php $observacao_final =
                                                ControladorStatic::getObservacaofinal($getEstudante->id,
                                                $getEstudante->ano_lectivo); ?>
                                                <tr class="{{ $observacao_final->observacao_final }}">
                                                    <th scope="row">{{ $getEstudante->id }}</th>
                                                    <td>
                                                        <img src="
                                                                                @if ($getEstudante->pessoa->foto) {{ asset($estudantes->pessoa->foto) }}
                                                    @else
                                                        {{ asset('assets/template/images/profile.png') }} @endif
                                                        " alt="" style="width:47px; height:47px; border-radius:4px;">
                                                    </td>
                                                    <td>{{ $getEstudante->pessoa->nome }}</td>
                                                    <td>{{ $getEstudante->turma->curso->curso }}</td>
                                                    <td>{{ $getEstudante->turma->classe->classe }}</td>
                                                    <td>{{ $getEstudante->turma->turno->turno }}</td>
                                                    <td>{{ $getEstudante->turma->turma }}</td>
                                                    <td>{{ $getEstudante->ano_lectivo }}</td>
                                                    <td>

                                                        <a href="/pagamentos/listar/{{ $getEstudante->id }}/{{ $getEstudante->ano_lectivo }}"
                                                            class="btn btn-success btn-sm"><i class="ti-money"></i> Pag.</a>
                                                        <a href="/estudantes/ficha/{{ $getEstudante->id }}/{{ $getEstudante->ano_lectivo }}"
                                                            class="btn btn-warning btn-sm"><i class="ti-user"></i> Ficha</a>
                                                        <a href="/estudantes/confirmar/{{ $getEstudante->id }}"
                                                            class="btn btn-info btn-sm"><i class="ti-file"></i> Confir.</a>
                                                        <a href="/estudantes/edit/{{ $getEstudante->id }}"
                                                            class="btn btn-primary btn-sm"><i class="ti-pencil-alt"></i>
                                                            Editar</a>
                                                        <a href="#" data-id_estudante="{{ $getEstudante->id }}"
                                                            data-nome_estudante="{{ $getEstudante->pessoa->nome }}"
                                                            class="btn btn-danger btn-sm delete"><i class="ti-trash"></i>
                                                            Eliminar</a>
                                                    </td>
                                                </tr>


                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            @else
                                Nenhum resultado encontrado
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- hidden-sm-up -->

    <!-- botão pesquisar -->
    <div class="btnPesquisar">
        <div class="btnPesquisarBtn">
            <a href="/estudantes" class="btn btn-primary btnCircular btnPrincipal" title="Novo"><i
                    class="ti-search"></i></a>
        </div>
    </div>




@endsection

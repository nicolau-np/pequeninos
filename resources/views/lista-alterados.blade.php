@extends('layouts.app')
@section('content')
<style>
    .text-danger{
        color: red;
    }
    </style>
<div class="row">
    <div class="col-md-12">
        <div class="anos">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nome Estudante</th>
                        <th>Turma</th>
                        <th>Ano Lectivo</th>
                        <th>Data de Criação</th>
                        <th>Data de Modificação</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($getHistoricoEstudanteAnos as $historico)
                        @php
                            $ano_criado = date('Y', strtotime($historico->created_at));
                            $class = null;
                            if ($ano_criado == 2021 && $historico->ano_lectivo == '2022-2023') {
                                $class = 'text-danger';
                            }

                        @endphp
                        <tr class="{{ $class }}">
                            <td>{{$historico->estudante->pessoa->nome}}</td>
                            <td>{{ $historico->turma->turma }}</td>
                            <td>{{ $historico->ano_lectivo }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($historico->created_at)) }}
                            </td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($historico->updated_at)) }}
                            </td>
                            <td>
                                @if ($class == 'text-danger')
                                    <a href="/estudantes/ficha_modificar/{{ $historico->id }}"
                                        class="btn btn-primary btn-sm">Mod.</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


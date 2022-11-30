@extends('layouts.app')
@section('content')
    <style>
        .title {
            font-weight: bold;
        }
    </style>
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $submenu }} &nbsp;&nbsp;&nbsp;
                            @foreach ($getHistoricoEstudanteAnos as $historicos_anos)
                                <a href="/estudantes/ficha/{{ $historicos_anos->id_estudante }}/{{ $historicos_anos->ano_lectivo }}"
                                    style="color:#4680ff;">{{ $historicos_anos->ano_lectivo }}</a>
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
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-danger">{{ session('success') }}</div>
                                @endif
                            </div>

                            <div class="col-md-12">
                                <div class="anos">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
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
                                                    <td>{{ $historico->turma->turma }}</td>
                                                    <td>{{ $historico->ano_lectivo }}</td>
                                                    <td>{{ date('d-m-Y H:i:s', strtotime($historico->created_at)) }}
                                                    </td>
                                                    <td>{{ date('d-m-Y H:i:s', strtotime($historico->updated_at)) }}
                                                    </td>
                                                    <td>
                                                        @if ($class == 'text-danger')
                                                            <a href="/estudantes/ficha/modificar/{{ $historico->id }}"
                                                                class="btn btn-primary btn-sm">Mod.</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">FICHAS ESTUDANTE
                                            {{ $getHistoricoEstudante->ano_lectivo }}</h5>
                                    </div>
                                    <div class="card-block accordion-block color-accordion-block">
                                        <div class="color-accordion" id="color-accordion">

                                            <a class="accordion-msg b-none">Dados Pessoais</a>
                                            <div class="accordion-desc">

                                                <div class="data">
                                                    <span class="title">Nome Completo:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->nome }}<br />
                                                    <span class="title">Gênero:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->genero }}<br />
                                                    <span class="title">Data de Nascimento:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->data_nascimento }}<br />
                                                    <span class="title">Estado Civíl:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->estado_civil }}<br />
                                                    <span class="title">Naturalidade:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->naturalidade }}<br />

                                                    <span class="title">Residencia:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->residencia }}<br />
                                                    <span class="title">Rua:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->rua }}<br />
                                                    <span class="title">Bairro:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->bairro }}<br />

                                                    <span class="title">Necessidade Especial:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->deficiencia }}
                                                    &nbsp;&nbsp;&nbsp;
                                                    {{ $getHistoricoEstudante->estudante->pessoa->tipo_deficiencia }}<br />

                                                    <span class="title">Telefone:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->telefone }}<br />
                                                    <span class="title">Nº do Bilhete:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->bilhete }}<br />
                                                    <span class="title">Data de Emissão:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->data_emissao }}<br />
                                                    <span class="title">Local de Emissão:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->local_emissao }}<br />
                                                    <span class="title">Pai:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->pai }}<br />
                                                    <span class="title">Mãe:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->mae }}<br />
                                                    <span class="title">Comuna:</span>
                                                    {{ $getHistoricoEstudante->estudante->pessoa->comuna }}<br />
                                                </div>
                                            </div>

                                            <a class="accordion-msg bg-dark-primary b-none">Dados Acadêmicos</a>
                                            <div class="accordion-desc">
                                                <div class="data">
                                                    <span class="title">Nº:</span>
                                                    {{ $getHistoricoEstudante->numero }}<br />
                                                    <span class="title">Nº Processo:</span>
                                                    {{ $getHistoricoEstudante->id_estudante }}<br />
                                                    <span class="title">Nº Acesso:</span>
                                                    {{ $getHistoricoEstudante->numero_acesso }}<br />
                                                    <span class="title">Curso:</span>
                                                    {{ $getHistoricoEstudante->turma->curso->curso }}<br />
                                                    <span class="title">Classe:</span>
                                                    {{ $getHistoricoEstudante->turma->classe->classe }}<br />
                                                    <span class="title">Turma:</span>
                                                    {{ $getHistoricoEstudante->turma->turma }}<br />
                                                    <span class="title">Turno:</span>
                                                    {{ $getHistoricoEstudante->turma->turno->turno }}<br />
                                                    <span class="title">Categoria:</span>
                                                    {{ $getHistoricoEstudante->categoria }}<br />
                                                    <span class="title">ESTADO FINAL:</span>
                                                    {{ strtoupper($getHistoricoEstudante->obs_pauta) }}<br />
                                                </div>

                                            </div>
                                            <a class="accordion-msg bg-darkest-primary b-none">Mais</a>
                                            <div class="accordion-desc">
                                                <div class="data">
                                                    <span class="title">Encarregado:</span>
                                                    {{ $getHistoricoEstudante->estudante->encarregado->pessoa->nome }}<br />
                                                    <span class="title">Telefone:</span>
                                                    {{ $getHistoricoEstudante->estudante->encarregado->pessoa->telefone }}<br />
                                                    <span class="title">OBS.:</span>
                                                    @if ($getHistoricoEstudante->observacao_final == 'transferido')
                                                        <span
                                                            class="{{ $getHistoricoEstudante->observacao_final }}">Transferência</span>
                                                    @elseif($getHistoricoEstudante->observacao_final == 'desistencia')
                                                        <span
                                                            class="{{ $getHistoricoEstudante->observacao_final }}">Desistência</span>
                                                    @endif
                                                    <br />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="
                                    @if ($getHistoricoEstudante->estudante->pessoa->foto) {{ asset($getHistoricoEstudante->estudante->pessoa->foto) }}
                                    @else
                                        {{ asset('assets/template/images/profile.png') }} @endif

                                        "
                                            alt="" style="width:100%; height:28vh; border-radius: 5px;">
                                        <br /><br />
                                    </div>

                                    <div class="col-md-12">

                                        <fieldset>
                                            <legend style="width:90%;"><b><i class="ti-settings"></i> Operações</b></legend>

                                            <div class="operacoes">
                                                <a href="/estudantes/declaracao/{{ $getHistoricoEstudante->id_estudante }}/{{ $getHistoricoEstudante->ano_lectivo }}"
                                                    class="btn btn-primary">Declaração</a>
                                                <hr />
                                                <a href="/estudantes/guiatransferencia/{{ $getHistoricoEstudante->id_estudante }}/{{ $getHistoricoEstudante->ano_lectivo }}"
                                                    class="btn btn-warning">Transferência</a>
                                                <hr />
                                                <a href="/estudantes/desistencia/{{ $getHistoricoEstudante->id_estudante }}/{{ $getHistoricoEstudante->ano_lectivo }}"
                                                    class="btn btn-danger">Desistência</a>
                                                <hr />
                                                <a href="/estudantes/termo/{{ $getHistoricoEstudante->id_estudante }}/{{ $getHistoricoEstudante->ano_lectivo }}"
                                                    class="btn btn-info">Termo</a>
                                                <hr />
                                                <a href="/estudantes/extrato/{{ $getHistoricoEstudante->id_estudante }}/{{ $getHistoricoEstudante->ano_lectivo }}"
                                                    class="btn btn-success">Extrato de Pagamentos</a>
                                                <!--<hr />-->
                                                <!--<a href="/estudantes/restringir_notas/{{ $getHistoricoEstudante->id_estudante }}/{{ $getHistoricoEstudante->ano_lectivo }}" class="btn btn-inverse">Restringir Notas</a>-->
                                            </div>

                                        </fieldset>

                                    </div>
                                </div>
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
            <a href="/estudantes/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i
                    class="ti-search"></i></a>
        </div>
    </div>
@endsection

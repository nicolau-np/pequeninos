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
                            {{ Form::open(['class' => 'form_search', 'method' => 'post', 'url' => '#']) }}
                            <div class="row text-right">
                                <div class="col-md-8">
                                    {{ Form::text('text_search', null, ['class' => 'form-control text_seach', 'placeholder' => 'Pesquisar...']) }}
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-success btn-sm"><i class="ti-search"></i></button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>

                        <div class="table-responsive">
                            <br />
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Descrição</th>
                                        <th>Data da Saída</th>
                                        <th>Valor</th>

                                        <th>Operações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($getSaidas->count() == 0)
                                        <span class="not_found">Nenhuma saida cadastrada</span>
                                    @else
                                        @foreach ($getSaidas as $saidas)

                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $saidas->descricao }}</td>
                                                <td>{{ date('d-m-Y', strtotime($saidas->data_saida)) }}</td>
                                                <td>{{ number_format($saidas->valor, 2, ',', '.') }}</td>

                                                <td>
                                                    <a href="/financas/saidas/edit/{{ $saidas->id }}"
                                                        class="btn btn-primary btn-sm"><i class="ti-pencil-alt"></i>
                                                        Editar</a>
                                                    <a href="http://" class="btn btn-danger btn-sm"><i class="ti-trash"></i>
                                                        Eliminar</a>
                                                </td>
                                            </tr>

                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                            <div class="totalgeral" style="font-weight: bold; color: #4680ff;">
                                Total: {{ number_format($getSaidas->sum('valor'),2,',','.') }}
                            </div>
                        </div>

                        <div class="pagination">
                            {{ $getSaidas->links() }}
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
            <a href="/financas/saidas/create" class="btn btn-primary btnCircular btnPrincipal" title="Novo"><i
                    class="ti-plus"></i></a>
        </div>
    </div>


@endsection

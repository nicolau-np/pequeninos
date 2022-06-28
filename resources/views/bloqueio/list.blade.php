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
                                    {{ Form::text('text_search', null, ['class' => 'form-control text_search', 'placeholder' => 'Pesquisar...']) }}
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-success btn-sm"><i class="ti-search"></i></button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>

                        <div class="table-responsive">
                            <br />
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Epoca / Designação</th>
                                        <th>Estado</th>
                                        <th>Operações</th>
                                    </tr>
                                </thead>
                                <tbody class="load_estudantes">
                                    @if ($getBloqueios->count() == 0)
                                        <span class="not_found">Nenhum tipo de bloqueio cadastrado</span>
                                    @else
                                        @foreach ($getBloqueios as $bloqueios)

                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    @if ($bloqueios->epoca != 6)
                                                        {{ $bloqueios->epoca }}ª Epoca
                                                    @else
                                                        Mudança de Observação
                                                    @endif
                                                </td>
                                                <td>{{ $bloqueios->estado }}</td>
                                                <td>
                                                    @if ($bloqueios->epoca != 6)
                                                        <a href="/bloqueios/config/{{ $bloqueios->id }}"
                                                            class="btn btn-warning btn-sm"><i class="fa fa-cogs"></i>
                                                            Configurar</a>&nbsp;&nbsp;
                                                    @endif
                                                    <a href="/bloqueios/update/{{ $bloqueios->id }}"
                                                        class="btn btn-primary btn-sm"><i class="ti-check"></i> Mudar
                                                        estado</a>
                                                </td>
                                            </tr>

                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- hidden-sm-up -->

    <!-- botão pesquisar -->


@endsection

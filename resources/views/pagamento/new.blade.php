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
                        <h5>
                            {{ $submenu }}
                            <i class="ti-angle-right"></i>
                            {{ $getTabelaPreco->tipo_pagamento->tipo }}
                            <i class="ti-angle-right"></i>
                            {{ number_format($getTabelaPreco->preco, 2, ',', '.') }}
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
                            </div>
                            <div class="col-md-12">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                            </div>

                            <div class="col-md-8">
                                <ul class="nav nav-tabs md-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home3" role="tab"
                                            aria-expanded="true">À Pagar</a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#profile3" role="tab"
                                            aria-expanded="false">Pagos</a>
                                        <div class="slide"></div>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#encarregado3" role="tab"
                                            aria-expanded="false">
                                            @if ($getEstudante->encarregado->pessoa->nome == 'Encarregado Exemplo')
                                                Não informado
                                            @else
                                                {{ $getEstudante->encarregado->pessoa->nome }}
                                            @endif
                                        </a>
                                        <div class="slide"></div>
                                    </li>

                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content card-block">
                                    <div class="tab-pane active" id="home3" role="tabpanel" aria-expanded="true">

                                        {{ Form::open(['method' => 'post', 'url' => '/pagamentos/store']) }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if ($getNaoPagos == null)
                                                    Já pagou todos meses
                                                @else
                                                    @if ($getTabelaPreco->forma_pagamento == 'Necessidade')
                                                        @foreach ($getNaoPagos as $nao_pagos)
                                                            <input type="checkbox" name="meses_a_pagar[]"
                                                                value="{{ $nao_pagos }}" />
                                                            {{ $getTabelaPreco->tipo_pagamento->tipo }} =>
                                                            @php
                                                                $valor_multa = 0;
                                                                $multa = ControladorStatic::getMultas($getEstudante->id, $getTabelaPreco->id_tipo_pagamento, $nao_pagos, $getEstudante->ano_lectivo);
                                                                if ($multa) {
                                                                    $valor_multa = ($getTabelaPreco->preco * $multa->percentagem) / 100;
                                                                }
                                                            @endphp
                                                            @if ($multa)
                                                                <span class="text-danger" style="font-weight: bold;">
                                                                    +
                                                                    {{ number_format($valor_multa, 2, ',', '.') }} Akz =>
                                                                </span>
                                                            @endif
                                                            <span class="preco"
                                                                style="color:#4680ff; font-weight:bold;">{{ number_format($getTabelaPreco->preco + $valor_multa, 2, ',', '.') }}
                                                                Akz</span>
                                                            <br />
                                                        @endforeach
                                                    @else
                                                        @foreach ($getNaoPagos as $nao_pagos)

                                                            <input type="checkbox" name="meses_a_pagar[]"
                                                                value="{{ $nao_pagos }}" /> {{ $nao_pagos }} =>
                                                            @php
                                                                $valor_multa = 0;
                                                                $multa = ControladorStatic::getMultas($getEstudante->id, $getTabelaPreco->id_tipo_pagamento, $nao_pagos, $getEstudante->ano_lectivo);
                                                                if ($multa) {
                                                                    $valor_multa = ($getTabelaPreco->preco * $multa->percentagem) / 100;
                                                                }
                                                            @endphp
                                                            @if ($multa)
                                                                <span class="text-danger" style="font-weight: bold;">
                                                                    +
                                                                    {{ number_format($valor_multa, 2, ',', '.') }} Akz =>
                                                                </span>
                                                            @endif
                                                            <span class="preco"
                                                                style="color:#4680ff; font-weight:bold;">{{ number_format($getTabelaPreco->preco + $valor_multa, 2, ',', '.') }}
                                                                Akz</span>
                                                            <br />


                                                        @endforeach
                                                    @endif
                                                    <div class="erro">
                                                        @if ($errors->has('meses_a_pagar'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('meses_a_pagar') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                                <hr />
                                            </div>
                                            <div class="col-md-6">
                                                {{ Form::label('data_entrada', 'Data de Entrada') }} <span
                                                    class="text-danger">*</span>
                                                {{ Form::date('data_entrada', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Data de entrada']) }}
                                            </div>
                                            <div class="col-md-6">
                                                {{ Form::label('descricao', 'Descrição') }}
                                                {{ Form::text('descricao', null, ['class' => 'form-control', 'placeholder' => 'Descrição']) }}
                                            </div>

                                            <div class="col-md-6">
                                                <br />
                                                {{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
                                            </div>
                                        </div>

                                        {{ Form::close() }}

                                    </div>

                                    <div class="tab-pane" id="profile3" role="tabpanel" aria-expanded="false">
                                        <p class="m-0">
                                            @if ($getPagos == null)
                                                Nenhum pago
                                            @else
                                                <ul>
                                                    @if ($getTabelaPreco->forma_pagamento == 'Necessidade')
                                                        @foreach ($getPagos as $pagos)
                                                            <li>{{ $loop->iteration }}º =>
                                                                <a data-epoca="{{ $pagos }}" href="#"
                                                                    style="color:#4680ff;"
                                                                    class="show_pagamento">{{ $getTabelaPreco->tipo_pagamento->tipo }}</a>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        @foreach ($getPagos as $pagos)
                                                            <li><a data-epoca="{{ $pagos }}" href="#"
                                                                    style="color:#4680ff;"
                                                                    class="show_pagamento">{{ $pagos }}</a></li>


                                                        @endforeach
                                                    @endif
                                                </ul>
                                            @endif
                                        </p>

                                        <div class="load_pagamento">

                                        </div>
                                    </div>

                                    <div class="tab-pane" id="encarregado3" role="tabpanel" aria-expanded="false">
                                        <p class="m-0">
                                        <ul>
                                            @if ($getEstudante->encarregado->pessoa->nome == 'Encarregado Exemplo')
                                                Encarregado não informado
                                            @else
                                                @foreach ($getEducandos as $educandos)
                                                    <li>{{ $educandos->pessoa->nome }}</li>
                                                @endforeach
                                            @endif

                                        </ul>
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <fieldset>
                                    <legend style="width:90%;"><b><i class="ti-user"></i>
                                            {{ $getHistoricoEstudante->estudante->pessoa->nome }}</b></legend>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Encarregado: {{ $getEstudante->encarregado->pessoa->nome }}</p>
                                            <p>Turma: {{ $getHistoricoEstudante->turma->turma }}</p>
                                            <p>Curso: {{ $getHistoricoEstudante->turma->curso->curso }}</p>
                                            <p>Classe: {{ $getHistoricoEstudante->turma->classe->classe }}</p>
                                            <p>Ano de Confirmação: {{ $getHistoricoEstudante->ano_lectivo }}</p>
                                        </div>
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
            <a href="/estudantes/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i
                    class="ti-search"></i></a>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.show_pagamento').click(function(e) {
                e.preventDefault();
                var data = {
                    epoca: $(this).data('epoca'),
                    _token: "{{ csrf_token() }}"
                };
                //$('.load_pagamento').html("hello:"+ epoca);
                $.ajax({
                    type: "post",
                    url: "{{ route('show_pagamento') }}",
                    data: data,
                    dataType: "html",
                    success: function(response) {
                        $('.load_pagamento').html(response);
                    }
                });
            });
        });

    </script>
@endsection

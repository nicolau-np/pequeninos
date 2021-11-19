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
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                            </div>

                            <div class="col-md-12">
                                {{ Form::open(['method' => 'post', 'class' => 'form-pagamentos']) }}
                                <div class="row">
                                    <div class="col-md-4">
                                        {{ Form::label('data_inicio', 'Definir Data') }} <span
                                            class="text-danger">*</span>
                                        {{ Form::date('data_inicio', null, ['class' => 'form-control data_inicio', 'placeholder' => 'Data']) }}
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <br />
                                        {{ Form::submit('SEGUIR', ['class' => 'btn btn-primary']) }}
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>

                            <div class="col-md-12">
                                <div class="loadPags">

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

    <script>
        $(document).ready(function(e) {
            $('.form-pagamentos').submit(function(e) {

                e.preventDefault();
                var data = {
                    data_inicio: $('.data_inicio').val(),
                    _token: "{{ csrf_token() }}"
                };
                if (data.data_inicio !== "") {
                    $.ajax({
                        type: "post",
                        url: "{{ route('getPagamentosEfectuados') }}",
                        data: data,
                        dataType: "html",
                        success: function(response) {
                            $('.loadPags').html(response);
                        }
                    });
                }

            })
        });

    </script>
@endsection

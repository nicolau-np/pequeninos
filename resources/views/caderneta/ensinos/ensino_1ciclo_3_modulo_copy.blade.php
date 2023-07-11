<?php
use App\Http\Controllers\ControladorStatic;

    ?>
    @extends('layouts.app')
    @section('content')
        <style>
            .avaliacao {
                width: 80px;
            }

            .prova {
                width: 80px;
            }

            .npe {
                width: 80px;
            }
            .nee {
                width: 80px;
            }
            .neo {
                width: 80px;
            }

            .rec {
                width: 80px;
            }
            .ms {
                width: 80px;
            }
            .exame{
                width:80px;
            }

        </style>
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $submenu }}
                                <i class="ti-angle-right"></i>
                                {{ $getHorario->turma->turma }}
                                <i class="ti-angle-right"></i>
                                {{ $getHorario->turma->turno->turno }}
                                <i class="ti-angle-right"></i>
                                {{ $getHorario->turma->curso->curso }}
                                <i class="ti-angle-right"></i>
                                {{ $getHorario->disciplina->disciplina }}
                                <i class="ti-angle-right"></i>
                                {{ $getHorario->ano_lectivo }}
                                <i class="ti-angle-right"></i>

                                    <a
                                        href="/cadernetas/store_copy_modulo/{{ $getHorario->id_turma }}/{{ $getHorario->id_disciplina }}/{{ $getHorario->ano_lectivo }}"><i
                                            class="ti-reload"></i></a>

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
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <div class="tabela_balanco">
                                <div class="col-lg-12 col-xl-12">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link active"
                                                    href="#">LANÇAMENTO</a>
                                                <div class="slide"></div>
                                            </li>

                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabs-left-content card-block">

                                            <div class="tab-pane active" role="tabpanel">
                                                <p class="m-0">


                                                <table class="table table-bordered tabela_notas">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="3">DADOS PESSOAIS</th>
                                                            <th colspan="2">PROVAS</th>
                                                            <th colspan="1">EXAME</th>

                                                        </tr>
                                                        <tr>
                                                            <th>Nº</th>
                                                            <th>NOME</th>
                                                            <th>G</th>
                                                            <th>MS1</th>
                                                            <th>MS2</th>
                                                            <th>EX</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>


                                                                @if ($getModuloFinals->count() == 0)
                                                                    Nenhum estudante encontrado
                                                                @else
                                                                    @foreach ($getModuloFinals as $modulo_finals)
                                                                        <?php
                                                                         ?>
                                                                        <tr class="">
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td>{{ $modulo_finals->estudante->pessoa->nome }}
                                                                            </td>
                                                                            <td>{{ $modulo_finals->estudante->pessoa->genero }}
                                                                            </td>

                                                                            <td>

                                                                                    <form method="post" class="form1">
                                                                                        <input type="number" name="ms1"
                                                                                            data-id="{{ $modulo_finals->id }}"
                                                                                            data-campo="ms1"
                                                                                            value="{{ $modulo_finals->ms1 }}"
                                                                                            class="form-control ms" />
                                                                                    </form>

                                                                            </td>
                                                                            <td>

                                                                                    <form method="post" class="form1">
                                                                                        <input type="number" name="ms2"
                                                                                            data-id="{{ $modulo_finals->id }}"
                                                                                            data-campo="ms2"
                                                                                            value="{{ $modulo_finals->ms2 }}"
                                                                                            class="form-control ms" />
                                                                                    </form>

                                                                            </td>


                                                                            <td>

                                                                                    <form method="post" class="form1">
                                                                                        <input type="number" name="exame"
                                                                                            data-id="{{ $modulo_finals->id }}"
                                                                                            data-campo="exame"
                                                                                            value="{{ $modulo_finals->exame }}"
                                                                                            class="form-control exame" />
                                                                                    </form>

                                                                            </td>

                                                                        </tr>
                                                                    @endforeach
                                                                @endif


                                                    </tbody>
                                                </table>

                                                </p>
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
                <a href="/cadernetas/list/{{ $getHorario->ano_lectivo }}"
                    class="btn btn-primary btnCircular btnPrincipal" title="Voltar"><i class="ti-arrow-left"></i></a>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $(".form1").submit(function(e) {
                    e.preventDefault();
                });
                $('.ms').on('keypress', function(e) {
                    if (e.which == 13) {
                        var valor = $(this).val();
                        var id_modulo = $(this).data('id');
                        var campo = $(this).data('campo');

                        if ((valor === "") || (valor < 0) || (valor > 10)) {
                            $(this).css({
                                'background': 'red',
                                'color': 'white',
                                'font-weight': 'bold'
                            });
                        } else {
                            var update = updateMS(valor, id_modulo, campo);
                            if (update) {
                                $(this).css({
                                    'background': 'green',
                                    'color': 'white',
                                    'font-weight': 'bold'
                                });
                            } else {
                                $(this).css({
                                    'background': 'red',
                                    'color': 'white',
                                    'font-weight': 'bold'
                                });
                            }
                        }
                    }
                });

                $('.exame').on('keypress', function(e) {
                    if (e.which == 13) {
                        var valor = $(this).val();
                        var id_modulo = $(this).data('id');
                        var campo = $(this).data('campo');

                        if ((valor === "") || (valor < 0) || (valor > 10)) {
                            $(this).css({
                                'background': 'red',
                                'color': 'white',
                                'font-weight': 'bold'
                            });
                        } else {
                            var update = updateMS(valor, id_modulo, campo);
                            if (update) {
                                $(this).css({
                                    'background': 'green',
                                    'color': 'white',
                                    'font-weight': 'bold'
                                });
                            } else {
                                $(this).css({
                                    'background': 'red',
                                    'color': 'white',
                                    'font-weight': 'bold'
                                });
                            }
                        }
                    }
                });


                function updateMS(valor, id_modulo, campo) {
                    retorno = false;
                    var data = {
                        valor: valor,
                        id_modulo: id_modulo,
                        campo: campo,
                        _token: "{{ csrf_token() }}"
                    };

                    $.ajax({
                        type: "post",
                        url: "{{ route('updateMS') }}",
                        data: data,
                        dataType: "html",
                        success: function(response) {

                            console.log(response);
                        }
                    });
                    return true;
                }

            });

        </script>
    @endsection

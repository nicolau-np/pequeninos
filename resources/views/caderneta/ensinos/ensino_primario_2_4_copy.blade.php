<?php
use App\Http\Controllers\ControladorStatic;
?>
@extends('layouts.app')
@section('content')
<style>
    .notaP, .notaA{
        width: 80px;
    }

    .npe{
        width: 80px;
    }
    .rec{
        width: 80px;
    }
</style>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->turma->turma}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->turma->turno->turno}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->turma->curso->curso}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->disciplina->disciplina}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->ano_lectivo}}
                    <i class="ti-angle-right"></i>
                    @if(session('epoca')!="4" && session('epoca')!="5")
                    <a href="/cadernetas/store_copy/{{$getHorario->id_turma}}/{{$getHorario->id_disciplina}}/{{session('epoca')}}/{{$getHorario->ano_lectivo}}"><i class="ti-reload"></i></a>
                    @endif
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
                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif

                    <div class="col-lg-12 col-xl-12">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">
                            @if ($getEpoca1->estado!="off")
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="1") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/1">1º TRIMESTRE</a>
                                <div class="slide"></div>
                            </li>
                            @endif
                            @if ($getEpoca2->estado!="off")
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="2") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/2">2º TRIMESTRE</a>
                                <div class="slide"></div>
                            </li>
                            @endif
                            @if ($getEpoca3->estado!="off")
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="3") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/3">3º TRIMESTRE</a>
                                <div class="slide"></div>
                            </li>
                            @endif
                            @if ($getEpoca4->estado!="off")
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="4") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/4">EXAME</a>
                                <div class="slide"></div>
                            </li>
                            @endif

                            @if ($getEpoca5->estado!="off")
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="5") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/5">REC</a>
                                <div class="slide"></div>
                            </li>
                            @endif
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs-left-content card-block">
                            @if ($getEpoca1->estado!="off")
                            <div class="tab-pane @if(session('epoca')=="1") active @endif" role="tabpanel">
                                <p class="m-0">

                                    {{Form::open(['method'=>"post"])}}
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">DADOS PESSOAIS</th>
                                                    <th colspan="3">AVALIAÇÕES</th>
                                                    <th colspan="2">PROVAS</th>
                                                </tr>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>NOME</th>
                                                    <th>G</th>
                                                    <th>OUT</th>
                                                    <th>NOV</th>
                                                    <th>DEZ</th>
                                                    <th>NPP</th>
                                                    <th>PT</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if (session('epoca')==1)
                                                    @if ($getTrimestral!=null)
                                                        @if ($getTrimestral->count()==0)
                                                            Nenhum estudante encontrado
                                                        @else
                                                            @foreach ($getTrimestral as $trimestral)
                                                            <?php
                                                                $observacao = ControladorStatic::getObservacaofinal($trimestral->id_estudante, $trimestral->ano_lectivo);
                                                            ?>
                                                                <tr class="{{$observacao->observacao_final}}">
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$trimestral->estudante->pessoa->nome}}</td>
                                                                <td>{{$trimestral->estudante->pessoa->genero}}</td>

                                                                <td>
                                                                    <input type="number" name="av1" data-id="{{$trimestral->id}}" data-campo="av1" value="{{$trimestral->av1}}" class="form-control avaliacao" />
                                                                </td>
                                                                <td>
                                                                    <input type="number" name="av2" data-id="{{$trimestral->id}}" data-campo="av2" value="{{$trimestral->av2}}" class="form-control avaliacao" />
                                                                </td>
                                                                <td>
                                                                    <input type="number" name="av3" data-id="{{$trimestral->id}}" data-campo="av3" value="{{$trimestral->av3}}" class="form-control avaliacao" />
                                                                </td>

                                                                <td>
                                                                    <input type="number" name="npp" data-id="{{$trimestral->id}}" data-campo="npp" value="{{$trimestral->npp}}" class="form-control prova" />
                                                                </td>
                                                                <td>
                                                                    <input type="number" name="npp" data-id="{{$trimestral->id}}" data-campo="pt" value="{{$trimestral->pt}}" class="form-control prova" />
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endif
                                            </tbody>
                                        </table>
                                    {{Form::close()}}
                                 </p>
                            </div>
                            @endif

                            @if ($getEpoca2->estado!="off")
                            <div class="tab-pane @if(session('epoca')=="2") active @endif" role="tabpanel">
                                <p class="m-0">
                                    {{Form::open(['method'=>"post"])}}
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="3">DADOS PESSOAIS</th>
                                                <th colspan="3">AVALIAÇÕES</th>
                                                <th colspan="2">PROVAS</th>
                                            </tr>
                                            <tr>
                                                <th>Nº</th>
                                                <th>NOME</th>
                                                <th>G</th>
                                                <th>JAN</th>
                                                <th>FEV</th>
                                                <th>MAR</th>
                                                <th>NPP</th>
                                                <th>PT</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (session('epoca')==2)
                                                @if ($getTrimestral!=null)
                                                    @if ($getTrimestral->count()==0)
                                                        Nenhum estudante encontrado
                                                    @else
                                                        @foreach ($getTrimestral as $trimestral)
                                                        <?php
                                                                $observacao = ControladorStatic::getObservacaofinal($trimestral->id_estudante, $trimestral->ano_lectivo);
                                                            ?>
                                                                <tr class="{{$observacao->observacao_final}}">
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$trimestral->estudante->pessoa->nome}}</td>
                                                            <td>{{$trimestral->estudante->pessoa->genero}}</td>

                                                            <td>
                                                                <input type="number" name="av1" data-id="{{$trimestral->id}}" data-campo="av1" value="{{$trimestral->av1}}" class="form-control avaliacao" />
                                                            </td>
                                                            <td>
                                                                <input type="number" name="av2" data-id="{{$trimestral->id}}" data-campo="av2" value="{{$trimestral->av2}}" class="form-control avaliacao" />
                                                            </td>
                                                            <td>
                                                                <input type="number" name="av3" data-id="{{$trimestral->id}}" data-campo="av3" value="{{$trimestral->av3}}" class="form-control avaliacao" />
                                                            </td>

                                                            <td>
                                                                <input type="number" name="npp" data-id="{{$trimestral->id}}" data-campo="npp" value="{{$trimestral->npp}}" class="form-control prova" />
                                                            </td>
                                                            <td>
                                                                <input type="number" name="npp" data-id="{{$trimestral->id}}" data-campo="pt" value="{{$trimestral->pt}}" class="form-control prova" />
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
                                    {{Form::close()}}
                                </p>
                            </div>
                            @endif

                            @if ($getEpoca3->estado!="off")
                            <div class="tab-pane @if(session('epoca')=="3") active @endif" role="tabpanel">
                                <p class="m-0">
                                    {{Form::open(['method'=>"post"])}}
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="3">DADOS PESSOAIS</th>
                                                <th colspan="3">AVALIAÇÕES</th>
                                                <th colspan="2">PROVAS</th>
                                            </tr>
                                            <tr>
                                                <th>Nº</th>
                                                <th>NOME</th>
                                                <th>G</th>
                                                <th>ABR</th>
                                                <th>MAI</th>
                                                <th>JUN</th>
                                                <th>NPP</th>
                                                <th>PT</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (session('epoca')==3)
                                                @if ($getTrimestral!=null)
                                                    @if ($getTrimestral->count()==0)
                                                        Nenhum estudante encontrado
                                                    @else
                                                        @foreach ($getTrimestral as $trimestral)
                                                        <?php
                                                                $observacao = ControladorStatic::getObservacaofinal($trimestral->id_estudante, $trimestral->ano_lectivo);
                                                            ?>
                                                                <tr class="{{$observacao->observacao_final}}">
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$trimestral->estudante->pessoa->nome}}</td>
                                                            <td>{{$trimestral->estudante->pessoa->genero}}</td>

                                                            <td>
                                                                <input type="number" name="av1" data-id="{{$trimestral->id}}" data-campo="av1" value="{{$trimestral->av1}}" class="form-control avaliacao" />
                                                            </td>
                                                            <td>
                                                                <input type="number" name="av2" data-id="{{$trimestral->id}}" data-campo="av2" value="{{$trimestral->av2}}" class="form-control avaliacao" />
                                                            </td>
                                                            <td>
                                                                <input type="number" name="av3" data-id="{{$trimestral->id}}" data-campo="av3" value="{{$trimestral->av3}}" class="form-control avaliacao" />
                                                            </td>

                                                            <td>
                                                                <input type="number" name="npp" data-id="{{$trimestral->id}}" data-campo="npp" value="{{$trimestral->npp}}" class="form-control prova" />
                                                            </td>
                                                            <td>
                                                                <input type="number" name="npp" data-id="{{$trimestral->id}}" data-campo="pt" value="{{$trimestral->pt}}" class="form-control prova" />
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
                                    {{Form::close()}}
                                </p>
                            </div>
                            @endif

                            @if ($getEpoca4->estado!="off")
                            <div class="tab-pane @if(session('epoca')=="4") active @endif" role="tabpanel">
                                @if(!$getCadeiraExame)
                                <p class="m-0"> Cadeira sem exames</p>
                                @else
                                <p class="m-0">
                                    {{Form::open(['method'=>"post"])}}
                                      <!-- provas-->

                                      <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="3">DADOS PESSOAIS</th>
                                                <th rowspan="2">NPE</th>
                                            </tr>
                                            <tr>
                                                <th>Nº</th>
                                                <th>NOME</th>
                                                <th>G</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (session('epoca')==4)
                                                @if ($getGlobal!=null)
                                                    @if ($getGlobal->count()==0)
                                                        Nenhum estudante encontrado
                                                    @else
                                                        @foreach ($getGlobal as $global)
                                                        <?php
                                                                $observacao = ControladorStatic::getObservacaofinal($global->id_estudante, $global->ano_lectivo);
                                                            ?>
                                                                <tr class="{{$observacao->observacao_final}}">
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$global->estudante->pessoa->nome}}</td>
                                                            <td>{{$global->estudante->pessoa->genero}}</td>

                                                            <td>
                                                                <input type="number" name="npe" data-id="{{$global->id}}" data-campo="npe" value="{{$global->npe}}" class="form-control npe" />
                                                            </td>

                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
                                {{Form::close()}}
                                </p>
                                @endif
                            </div>
                            @endif

                            @if ($getEpoca5->estado!="off")
                            <div class="tab-pane @if(session('epoca')=="5") active @endif" role="tabpanel">
                                @if (!$getCadeiraRecurso)
                                <p class="m-0">Cadeira sem Recurso</p>
                                @else
                                <p class="m-0">
                                    {{Form::open(['method'=>"post"])}}
                                      <!-- provas-->

                                      <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="3">DADOS PESSOAIS</th>
                                                <th rowspan="2">REC</th>
                                            </tr>
                                            <tr>
                                                <th>Nº</th>
                                                <th>NOME</th>
                                                <th>G</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (session('epoca')==5)
                                                @if ($getGlobal!=null)
                                                    @if ($getGlobal->count()==0)
                                                        Nenhum estudante encontrado
                                                    @else
                                                        @foreach ($getGlobal as $global)
                                                        <?php
                                                                $observacao = ControladorStatic::getObservacaofinal($global->id_estudante, $global->ano_lectivo);
                                                            ?>
                                                                <tr class="{{$observacao->observacao_final}}">
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$global->estudante->pessoa->nome}}</td>
                                                            <td>{{$global->estudante->pessoa->genero}}</td>

                                                            <td>
                                                                @if ($global->mf>=5)
                                                                <input type="number" name="rec" value="" class="form-control" disabled />
                                                                @else
                                                                    <input type="number" name="rec" data-id="{{$global->id}}" data-campo="rec" value="{{$global->rec}}" class="form-control rec" />
                                                                @endif
                                                            </td>

                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
                                {{Form::close()}}
                                </p>
                                @endif
                            </div>
                            @endif
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
        <a href="/cadernetas/list/{{$getHorario->ano_lectivo}}" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

<script>
    $(document).ready(function () {

        $('.avaliacao').on('keypress', function(e){
            if(e.which == 13){
                var valor = $(this).val();
                var id_trimestral = $(this).data('id');
                var campo = $(this).data('campo');

                if((valor==="") || (valor<0) || (valor>10)){
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }else{
                    var update = updateAvaliacao(valor, id_trimestral, campo);
                    if(update){
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }else{
                        $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                    }
                }
            }
        });

        $('.prova').on('keypress', function(e){
            if(e.which == 13){
                var valor = $(this).val();
                var id_trimestral = $(this).data('id');
                var campo = $(this).data('campo');

                if((valor==="") || (valor<0) || (valor>10)){
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }else{
                    var update = updateProva(valor, id_trimestral, campo);
                    if(update){
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }else{
                        $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                    }
                }
            }
        });

        $('.npe').on('keypress', function(e){
            if(e.which == 13){
                var valor = $(this).val();
                var id_final = $(this).data('id');
                var campo = $(this).data('campo');

                if((valor==="") || (valor<0) || (valor>10)){
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }else{
                    var update = updateGlobal(valor, id_final, campo);
                    if(update){
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }else{
                        $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                    }
                }
            }
        });

        $('.rec').on('keypress', function(e){
            if(e.which == 13){
                var valor = $(this).val();
                var id_final = $(this).data('id');
                var campo = $(this).data('campo');

                if((valor==="") || (valor<0) || (valor>5)){
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }else{
                    var update = updateRecurso(valor, id_final, campo);
                    if(update){
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }else{
                        $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                    }
                }
            }
        });

        function updateRecurso(valor, id_final, campo){
            retorno = false;
            var data = {
                valor: valor,
                id_final: id_final,
                campo: campo,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                type: "post",
                url: "{{route('updateRecurso')}}",
                data: data,
                dataType: "html",
                success: function (response) {

                    console.log(response);
                }
            });
            return true;
        }


        function updateGlobal(valor, id_final, campo){
            retorno = false;
            var data = {
                valor: valor,
                id_final: id_final,
                campo: campo,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                type: "post",
                url: "{{route('updateGlobal')}}",
                data: data,
                dataType: "html",
                success: function (response) {

                    console.log(response);
                }
            });
            return true;
        }


        function updateAvaliacao(valor, id_trimestral, campo){
            retorno = false;
            var data = {
                valor: valor,
                id_trimestral: id_trimestral,
                campo: campo,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                type: "post",
                url: "{{route('updateAvaliacao')}}",
                data: data,
                dataType: "html",
                success: function (response) {

                    console.log(response);
                }
            });
            return true;
        }

        function updateProva(valor, id_trimestral, campo){
            retorno = false;
            var data = {
                valor: valor,
                id_trimestral: id_trimestral,
                campo: campo,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                type: "post",
                url: "{{route('updateProva')}}",
                data: data,
                dataType: "html",
                success: function (response) {

                    console.log(response);
                }
            });
            return true;
        }

    });
</script>
@endsection

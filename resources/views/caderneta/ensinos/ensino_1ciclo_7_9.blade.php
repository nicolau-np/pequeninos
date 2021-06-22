@extends('layouts.app')
@section('content')
<style>
    .notaP, .notaA{
        width: 70px;
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
                    {{$getHorario->disciplina->disciplina}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->ano_lectivo}}
                    <i class="ti-angle-right"></i>
                    <a href="/cadernetas/store_copy/{{$getHorario->id_turma}}/{{$getHorario->id_disciplina}}/{{session('epoca')}}/{{$getHorario->ano_lectivo}}"><i class="ti-reload"></i></a>
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

                    <div class="col-lg-12 col-xl-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="1") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/1">1º Trimestre</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="2") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/2">2º Trimestre</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="3") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/3">3º Trimestre</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="4") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/4">Global</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs-left-content card-block">
                            <div class="tab-pane @if(session('epoca')=="1") active @endif" role="tabpanel">
                                <p class="m-0">

                                    {{Form::open(['method'=>"post"])}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!--1 trimestre-->
                                             <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">Nº</th>
                                                        <th rowspan="2">Estudante</th>
                                                        <th colspan="1">MAC</th>
                                                        <th colspan="1">CPP</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (session('epoca')==1)
                                        @if ($getAvaliacao!=null)
                                            @if ($getAvaliacao->count()==0)
                                                Nenhum estudante encontrado
                                            @else
                                            @foreach ($getAvaliacao as $avaliacao)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$avaliacao->estudante->pessoa->nome}}</td>
                                                <td>
                                                <input type="number" name="mac" data-id="{{$avaliacao->id}}" data-campo="1" value="{{$avaliacao->valo1}}" class="form-control notaA" />
                                                </td>
                                                <td>
                                                <input type="number" name="cpp" data-id="{{$avaliacao->id}}" data-campo="2" value="{{$avaliacao->valo2}}" class="form-control notaA" />
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        @endif
                                    @endif

                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                    {{Form::close()}}
                                 </p>
                            </div>
                            <div class="tab-pane @if(session('epoca')=="2") active @endif" role="tabpanel">
                                <p class="m-0">
                                    {{Form::open(['method'=>"post"])}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!--2 trimestre-->
                                             <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">Nº</th>
                                                        <th rowspan="2">Estudante</th>
                                                        <th colspan="1">MAC</th>
                                                        <th colspan="1">CPP</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (session('epoca')==2)
                                        @if ($getAvaliacao!=null)
                                            @if ($getAvaliacao->count()==0)
                                                Nenhum estudante encontrado
                                            @else
                                            @foreach ($getAvaliacao as $avaliacao)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$avaliacao->estudante->pessoa->nome}}</td>
                                                <td>
                                                <input type="number" name="mac" data-id="{{$avaliacao->id}}" data-campo="1" value="{{$avaliacao->valo1}}" class="form-control notaA" />
                                                </td>
                                                <td>
                                                <input type="number" name="cpp" data-id="{{$avaliacao->id}}" data-campo="2" value="{{$avaliacao->valo2}}" class="form-control notaA" />
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        @endif
                                    @endif

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{Form::close()}}
                                </p>
                            </div>
                            <div class="tab-pane @if(session('epoca')=="3") active @endif" role="tabpanel">
                                <p class="m-0">
                                    {{Form::open(['method'=>"post"])}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!--3 trimestre-->
                                             <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">Nº</th>
                                                        <th rowspan="2">Estudante</th>
                                                        <th colspan="1">MAC</th>
                                                        <th colspan="1">CPP</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (session('epoca')==3)
                                        @if ($getAvaliacao!=null)
                                            @if ($getAvaliacao->count()==0)
                                                Nenhum estudante encontrado
                                            @else
                                            @foreach ($getAvaliacao as $avaliacao)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$avaliacao->estudante->pessoa->nome}}</td>
                                                <td>
                                                <input type="number" name="mac" data-id="{{$avaliacao->id}}" data-campo="1" value="{{$avaliacao->valo1}}" class="form-control notaA" />
                                                </td>
                                                <td>
                                                <input type="number" name="cpp" data-id="{{$avaliacao->id}}" data-campo="2" value="{{$avaliacao->valo2}}" class="form-control notaA" />
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        @endif
                                    @endif

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{Form::close()}}
                                </p>
                            </div>
                            <div class="tab-pane @if(session('epoca')=="4") active @endif" role="tabpanel">
                                <p class="m-0">
                                    {{Form::open(['method'=>"post"])}}
                                      <!-- provas-->
                                      <div class="row">
                                      <div class="col-md-12">
                                        <table class="table table-bordered">
                                           <thead>
                                               <tr>
                                                   <th rowspan="2">Nº</th>
                                                   <th rowspan="2">Estudante</th>
                                                   <th>Prova Global</th>
                                               </tr>
                                               <tr>
                                                   <th>CPE</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               @if (session('epoca')==4)
                                   @if ($getGlobal!=null)
                                       @if ($getGlobal->count()==0)
                                           Nenhum estudante encontrado
                                       @else
                                       @foreach ($getGlobal as $global)
                                       <tr>
                                       <td>{{$loop->iteration}}</td>
                                       <td>{{$global->estudante->pessoa->nome}}</td>
                                        <td>
                                            <input type="number" name="global" data-id="{{$global->id}}" data-campo="cpe" value="{{$global->cpe}}" class="form-control notaG" />
                                        </td>
                                       </tr>
                                       @endforeach
                                       @endif
                                   @endif
                               @endif

                                           </tbody>
                                       </table>
                                   </div>
                                </div>
                                {{Form::close()}}
                                </p>
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
		<a href="/cadernetas/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

<script>
    $(document).ready(function () {
        $('.notaA').on('keypress', function(e){
            if(e.which == 13){
                var valor = $(this).val();
                var id_avalicao = $(this).data('id');
                var campo = $(this).data('campo');

                if((valor==="") || (valor<0) || (valor>20)){
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }else{
                    var update = updateAvaliacao(valor, id_avalicao, campo);
                    if(update){
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }else{
                        $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                    }
                }

            }
        });

        $('.notaP').on('keypress', function(e){
            if(e.which == 13){
                var valor = $(this).val();
                var id_prova = $(this).data('id');
                var campo = $(this).data('campo');
                if((valor==="") || (valor<0) || (valor>20)){
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }else{
                    prova = updateProva(valor, id_prova, campo);
                    if(prova){
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }else{
                        $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                    }

                }
            }
        });

        $('.notaG').on('keypress', function(e){
            if(e.which == 13){
                var valor = $(this).val();
                var id_global = $(this).data('id');
                if((valor==="") || (valor<0) || (valor>20)){
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }else{
                    global = updateGlobal(valor, id_global);
                    if(global){
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }else{
                        $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                    }

                }
            }
        });

        function updateAvaliacao(valor, id_avalicao, campo){
            retorno = false;
            var data = {
                valor: valor,
                id_avaliacao: id_avalicao,
                campo: campo,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                type: "post",
                url: "{{route('updateAvaliacao')}}",
                data: data,
                dataType: "json",
                async: false,
                success: function (response) {
                    if(response.status === "ok"){
                      retorno = true;
                    }else{
                        retorno = false;
                    }
                    console.log(response.sms);
                }
            });
            return retorno;
        }

        function updateProva(valor, id_prova, campo){
            retorno = false;
            var data = {
                valor: valor,
                id_prova: id_prova,
                campo: campo,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                type: "post",
                url: "{{route('updateProva')}}",
                data: data,
                dataType: "json",
                async: false,
                success: function (response) {
                    if(response.status === "ok"){
                      retorno = true;
                    }else{
                        retorno = false;
                    }
                    console.log(response.sms);
                }
            });
            return retorno;
        }

        function updateGlobal(valor, id_global){
            retorno = false;
            var data = {
                valor: valor,
                id_global: id_global,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                type: "post",
                url: "{{route('updateGlobal')}}",
                data: data,
                dataType: "json",
                async: false,
                success: function (response) {
                    if(response.status === "ok"){
                      retorno = true;
                    }else{
                        retorno = false;
                    }
                    console.log(response.sms);
                }
            });
            return retorno;
        }

     });
</script>
@endsection

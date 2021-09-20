@extends('layouts.app')
@section('content')
<style>
    .notaP, .notaA{
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
                    {{$getHorario->disciplina->disciplina}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->ano_lectivo}}
                    <i class="ti-angle-right"></i>
                    @if(session('epoca')!="4")
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
                                <a class="nav-link @if(session('epoca')=="1") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/1">1º Trimestre</a>
                                <div class="slide"></div>
                            </li>
                            @endif
                            @if ($getEpoca2->estado!="off")
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="2") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/2">2º Trimestre</a>
                                <div class="slide"></div>
                            </li>
                            @endif
                            @if ($getEpoca3->estado!="off")
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="3") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/3">3º Trimestre</a>
                                <div class="slide"></div>
                            </li>
                            @endif
                            @if ($getEpoca4->estado!="off")
                            <li class="nav-item">
                                <a class="nav-link @if(session('epoca')=="4") active @endif" href="/cadernetas/create/{{$getId_turma}}/{{$getId_disciplina}}/{{$getAno_lectivo}}/4">Global</a>
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
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th colspan="3">DADOS PESSOAIS</th>
                                                    <th colspan="3">AVALIAÇÃO</th>
                                                </tr>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>NOME</th>
                                                    <th>G</th>
                                                    <th>SET</th>
                                                    <th>OUT</th>
                                                    <th>NOV</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if (session('epoca')==1)
                                                    @if ($getTrimestral!=null)
                                                        @if ($getTrimestral->count()==0)
                                                            Nenhum estudante encontrado
                                                        @else
                                                            @foreach ($getTrimestral as $trimestral)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$trimestral->estudante->pessoa->nome}}</td>
                                                                <td>{{$trimestral->estudante->pessoa->genero}}</td>
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

                                    {{Form::close()}}
                                </p>
                            </div>
                            @endif

                            @if ($getEpoca3->estado!="off")
                            <div class="tab-pane @if(session('epoca')=="3") active @endif" role="tabpanel">
                                <p class="m-0">
                                    {{Form::open(['method'=>"post"])}}

                                    {{Form::close()}}
                                </p>
                            </div>
                            @endif

                            @if ($getEpoca4->estado!="off")
                            <div class="tab-pane @if(session('epoca')=="4") active @endif" role="tabpanel">
                                <p class="m-0">
                                    {{Form::open(['method'=>"post"])}}
                                      <!-- provas-->

                                {{Form::close()}}
                                </p>
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
		<a href="/cadernetas/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

<script>
    $(document).ready(function () {
        $('.notaA').on('keypress', function(e){
            if(e.which == 13){
                var valor = $(this).val();
                var id_trimestral = $(this).data('id');
                var campo = $(this).data('campo');

                if((valor==="") || (valor<0) || (valor>20)){
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }else{
                    var update = updatetrimestral(valor, id_trimestral, campo);
                    if(update){
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


        function updatetrimestral(valor, id_trimestral, campo){
            retorno = false;
            var data = {
                valor: valor,
                id_trimestral: id_trimestral,
                campo: campo,
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                type: "post",
                url: "{{route('updatetrimestral')}}",
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
            return true;
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
            return true;
        }

     });
</script>
@endsection

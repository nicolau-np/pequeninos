<?php
$estF = 0;
$estM = 0;

$estT = 0;

foreach($getHistorico as $historico){
    if($historico->estudante->pessoa->genero == "M"){
        $estM ++;
    }else{
        $estF ++;
    }
    $estT ++;
}
?>
@extends('layouts.app')
@section('content')
<style>
.total{
    font-weight:bold;
}
.total_geral{
    font-weight:bold;
    font-size:13px;
}
</style>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}} <i class="ti-angle-right"></i>
                        {{$getHorario->turma->turma}}<i class="ti-angle-right"></i>
                        {{$getHorario->disciplina->disciplina}}<i class="ti-angle-right"></i>
                        {{$getAno}}

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
                    <div>
                         @if(session('error'))
                         <div class="alert alert-danger">{{session('error')}}</div>
                         @endif
                    </div>


                    <div class="grafico">
                        <div class="col-lg-12 col-xl-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home5" role="tab">Trimestral</a>
                                    <div class="slide"></div>
                                </li>

                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabs-left-content card-block">
                                <div class="tab-pane active" id="home5" role="tabpanel">
                                    <p class="m-0">
                                        <div class="table-responsive">
                                            <!-- espaco para tabela-->
                                            <table class="table table-bordered" style="font-size:12px;">
                                            <thead>
                                                <tr>
                                                    <th colspan="13">
                                                        Total de Estudantes: {{$estT}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        Masculino: {{$estM}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        Femenino: {{$estF}}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th colspan="3">1º Trimestre</th>
                                                    <th colspan="3">2º Trimestre</th>
                                                    <th colspan="3">3º Trimestre</th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>M</th>
                                                    <th>F</th>
                                                    <th>T</th>

                                                    <th>M</th>
                                                    <th>F</th>
                                                    <th>T</th>

                                                    <th>M</th>
                                                    <th>F</th>
                                                    <th>T</th>

                                                    <th>Total Geral</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Positivas</td>

                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

                                                    <td></td>
                                                 </tr>
                                                 <tr>
                                                    <td>Negativas</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

                                                    <td></td>
                                                 </tr>
                                                 <tr>
                                                     <?php
                                                        /*variaveis de todos semestres*/
                                                        $la1 = 0;
                                                        $la1F = 0;
                                                        $la1M = 0;

                                                        $la2 = 0;
                                                        $la2F = 0;
                                                        $la2M = 0;

                                                        $la3 = 0;
                                                        $la3F = 0;
                                                        $la3M = 0;

                                                        $la_total = 0;
                                                        /*fim*/

                                                        /*primeiro trimestre lancamentos*/
                                                        foreach ($getTrimestral1 as $t1){
                                                        if($t1->ct!=""){
                                                            if($t1->estudante->pessoa->genero == "M"){
                                                                $la1M ++;
                                                            }else{
                                                                $la1F ++;
                                                            }
                                                            $la1 ++;
                                                        }
                                                        }
                                                        /*fim*/

                                                         /*segundo trimestre lancamentos*/
                                                        foreach ($getTrimestral2 as $t2){
                                                        if($t2->ct!=""){
                                                            if($t2->estudante->pessoa->genero == "M"){
                                                                $la2M ++;
                                                            }else{
                                                                $la2F ++;
                                                            }
                                                            $la2 ++;
                                                        }
                                                        }
                                                        /*fim*/

                                                         /*terceiro trimestre lancamentos*/
                                                        foreach ($getTrimestral3 as $t3){
                                                        if($t3->ct!=""){
                                                            if($t3->estudante->pessoa->genero == "M"){
                                                                $la3M ++;
                                                            }else{
                                                                $la3F ++;
                                                            }
                                                            $la3 ++;
                                                        }
                                                        }
                                                        /*fim*/

                                                        $la_total=$la1+$la2+$la3;
                                                        ?>
                                                     <td>Lançamentos</td>

                                                    <td>{{$la1M}}</td>
                                                    <td>{{$la1F}}</td>
                                                    <td class="total">{{$la1}}</td>


                                                    <td>{{$la2M}}</td>
                                                    <td>{{$la2F}}</td>
                                                    <td class="total">{{$la2}}</td>

                                                    <td>{{$la3M}}</td>
                                                    <td>{{$la3F}}</td>
                                                    <td class="total">{{$la3}}</td>

                                                    <td class="total_geral">{{$la_total}}</td>
                                                 </tr>
                                            </tbody>
                                            </table>
                                            <!-- fim -->
                                        </div>
                                        <!-- pagamentos trimestrais-->
                                        <figure class="highcharts-figure">
                                            <div id="container_trimestral" style="width: 100%;"></div>
                                            <p class="highcharts-description">
                                                Gráfico de barras ilustrando o aproveitamento da turma em todos os trimestres,
                                            </p>
                                        </figure>

                                       <!-- espaco para o grafico-->

                                       <!-- fim -->
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


@endsection

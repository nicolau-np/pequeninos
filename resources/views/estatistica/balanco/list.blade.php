@php 
use App\Http\Controllers\ControladorStatic;
$trimestres = ['1 Trimestre','2 Trimestre','3 Trimestre',];
$meses = [1,2,3,4,5,6,7,8,9,10,11,12,];
@endphp
@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}} <i class="ti-angle-right"></i> 
                        @foreach ($getAnos as $anos)
                            <a href="/estatisticas/balancos/list/{{$anos->ano_lectivo}}" style="color:#4680ff;">{{$anos->ano_lectivo}}</a>
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
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profile5" role="tab">Mensal</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#messages5" role="tab">Anual</a>
                                    <div class="slide"></div>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabs-left-content card-block">
                                <div class="tab-pane active" id="home5" role="tabpanel">
                                    <p class="m-0">
                                        <!-- pagamentos trimestrais-->
                                        <figure class="highcharts-figure">
                                            <div id="container_trimestral" style="width: 100%;"></div>
                                            <p class="highcharts-description">
                                                Gráfico de barras ilustrando os pagamentos feitos de forma trimestral, 
                                                contabiliza apenas aqueles pagamentos que são feito de trimestre em trimetre.
                                            </p>
                                        </figure>
                                        
                                        <script type="text/javascript">
                                        Highcharts.chart('container_trimestral', {
                                            chart: {
                                                type: 'column'
                                            },
                                            title: {
                                                text: 'Grafico demonstrativo dos Balanços do ano {{$getAno}}'
                                            },
                                            subtitle: {
                                                text: 'Source: okussoleka.com'
                                            },
                                            xAxis: {
                                                categories: [
                                                    <?php 
                                                        foreach($trimestres as $trimestre){
                                                        ?>
                                                    '{{$trimestre}}',
                                                    <?php }?>
                                                ],
                                                crosshair: true
                                            },
                                            yAxis: {
                                                min: 0,
                                                title: {
                                                    text: 'Valores (Akz)'
                                                }
                                            },
                                            tooltip: {
                                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                                    '<td style="padding:0"><b>{point.y:,2f} Akz</b></td></tr>',
                                                footerFormat: '</table>',
                                                shared: true,
                                                useHTML: true
                                            },
                                            plotOptions: {
                                                column: {
                                                    pointPadding: 0.2,
                                                    borderWidth: 0
                                                }
                                            },
                                            series: [
                                                <?php
                                                foreach($getTipoPagamentos as $tipo_pagamentos){
                                                ?>
                                                {
                                                name: '{{$tipo_pagamentos->tipo}}',
                                                data: [
                                                    <?php
                                                    foreach($trimestres as $trimestre){
                                                        $valores = ControladorStatic::getValoresBalancoTrimestral($trimestre, $tipo_pagamentos->id, $getAno);
                                                    ?>
                                                    {{$valores}},  
                                                    <?php }?>
                                                    ]
                                        
                                            },
                                            <?php }?>
                                            ]
                                        });
                                    </script>
                                    </p>
                                </div>
                                <div class="tab-pane" id="profile5" role="tabpanel">
                                    <p class="m-0">
                                        <!-- pagamentos mensais-->
                                        <figure class="highcharts-figure">
                                            <div id="container_mensal" style="width: 100%;"></div>
                                            <p class="highcharts-description">
                                                Gráfico de barras ilustrando os pagamentos feitos em um determinado mês, 
                                                contabiliza todos pagamentos.
                                            </p>
                                        </figure>
                                        
                                        <script type="text/javascript">
                                        Highcharts.chart('container_mensal', {
                                            chart: {
                                                type: 'column'
                                            },
                                            title: {
                                                text: 'Grafico demonstrativo dos Balanços do ano {{$getAno}}'
                                            },
                                            subtitle: {
                                                text: 'Source: okussoleka.com'
                                            },
                                            xAxis: {
                                                categories: [
                                                    <?php 
                                                        foreach($meses as $mes){
                                                            $getMes = ControladorStatic::converterMes($mes);
                                                        ?>
                                                    '{{$getMes}}',
                                                    <?php }?>
                                                ],
                                                crosshair: true
                                            },
                                            yAxis: {
                                                min: 0,
                                                title: {
                                                    text: 'Valores (Akz)'
                                                }
                                            },
                                            tooltip: {
                                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                                    '<td style="padding:0"><b>{point.y:,2f} Akz</b></td></tr>',
                                                footerFormat: '</table>',
                                                shared: true,
                                                useHTML: true
                                            },
                                            plotOptions: {
                                                column: {
                                                    pointPadding: 0.2,
                                                    borderWidth: 0
                                                }
                                            },
                                            series: [
                                                <?php
                                                foreach($getTipoPagamentos as $tipo_pagamentos){
                                                ?>
                                                {
                                                name: '{{$tipo_pagamentos->tipo}}',
                                                data: [
                                                    <?php
                                                    foreach($meses as $mes){
                                                        $valores = ControladorStatic::getValoresBalancoMensal($mes, $tipo_pagamentos->id, $getAno);
                                                    ?>
                                                    {{$valores}},  
                                                    <?php }?>
                                                    ]
                                        
                                            },
                                            <?php }?>
                                            ]
                                        });
                                    </script>
                                    </p>
                                </div>
                                <div class="tab-pane" id="messages5" role="tabpanel">
                                    <p class="m-0">
                                        <!-- pagamentos anuais-->
                                        <figure class="highcharts-figure">
                                            <div id="container_anual" style="width: 100%;"></div>
                                            <p class="highcharts-description">
                                                Gráfico de barras ilustrando os pagamentos feitos durante um determinado ano, 
                                                contabiliza todos os pagamentos do ano.
                                            </p>
                                        </figure>
                                        
                                        <script type="text/javascript">
                                        Highcharts.chart('container_anual', {
                                            chart: {
                                                type: 'column'
                                            },
                                            title: {
                                                text: 'Grafico demonstrativo dos Balanços do ano {{$getAno}}'
                                            },
                                            subtitle: {
                                                text: 'Source: okussoleka.com'
                                            },
                                            xAxis: {
                                                categories: [
                                                    
                                                    '{{$getAno}}',
                                                ],
                                                crosshair: true
                                            },
                                            yAxis: {
                                                min: 0,
                                                title: {
                                                    text: 'Valores (Akz)'
                                                }
                                            },
                                            tooltip: {
                                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                                    '<td style="padding:0"><b>{point.y:,2f} Akz</b></td></tr>',
                                                footerFormat: '</table>',
                                                shared: true,
                                                useHTML: true
                                            },
                                            plotOptions: {
                                                column: {
                                                    pointPadding: 0.2,
                                                    borderWidth: 0
                                                }
                                            },
                                            series: [
                                                <?php
                                                foreach($getTipoPagamentos as $tipo_pagamentos){
                                                ?>
                                                {
                                                name: '{{$tipo_pagamentos->tipo}}',
                                                data: [
                                                    <?php
                                                        $valores = ControladorStatic::getValoresBalancoAnual($tipo_pagamentos->id, $getAno);
                                                    ?>
                                                    {{$valores}},  
                                                    <?php ?>
                                                    ]
                                        
                                            },
                                            <?php }?>
                                            ]
                                        });
                                    </script>
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
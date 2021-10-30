@php
use App\Http\Controllers\ControladorStatic;

$meses = [9,10,11,12,1,2,3,4,5,6,7,8];
$total = [
    'set'=>0,
    'out'=>0,
    'nov'=>0,
    'dez'=>0,
    'jan'=>0,
    'fev'=>0,
    'mar'=>0,
    'abr'=>0,
    'mai'=>0,
    'jun'=>0,
    'jul'=>0,
    'ago'=>0,
];

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
                            <a href="/mapas/balancos/geral/{{$anos->ano_lectivo}}" style="color:#4680ff;">{{$anos->ano_lectivo}}</a>
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

                    <div class="descricao">
                        Ano Lectivo: {{ $getAno }}
                    </div>
                    <div class="grafico tabela_balanco">
                        <div class="col-lg-12 col-xl-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#profile5" role="tab">Mensal</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#messages5" role="tab">Anual</a>
                                    <div class="slide"></div>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabs-left-content card-block">

                                <div class="tab-pane active" id="profile5" role="tabpanel">
                                    <p class="m-0">
                                        <div class="tabela_balanco">
                                            <table class="table table-bordered" style="font-size:12px;">
                                                <thead>
                                                    <tr>
                                                        <th>Tipos de Pagamentos</th>
                                                        <?php
                                                        foreach($meses as $mes){
                                                            $getMes = ControladorStatic::converterMes($mes);
                                                        ?>
                                                        <th>{{$getMes}}</th>
                                                        <?php }?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach($getTipoPagamentos as $tipo_pagamentos){
                                                    ?>
                                                    <tr>
                                                    <td>{{$tipo_pagamentos->tipo}}</td>
                                                        <?php
                                                        foreach($meses as $mes){
                                                        $valores = ControladorStatic::getValoresBalancoMensal($mes, $tipo_pagamentos->id, $getAno);
                                                        /* calculando totais*/
                                                        /*setembro*/
                                                        if($mes==9){
                                                            $total['set'] = $total['set']+$valores;
                                                        }elseif($mes==10){
                                                            $total['out'] = $total['out']+$valores;
                                                        }elseif($mes==11){
                                                            $total['nov'] = $total['nov']+$valores;
                                                        }elseif($mes==12){
                                                            $total['dez'] = $total['dez']+$valores;
                                                        }elseif($mes==1){
                                                            $total['jan'] = $total['jan']+$valores;
                                                        }elseif($mes==2){
                                                            $total['fev'] = $total['fev']+$valores;
                                                        }elseif($mes==3){
                                                            $total['mar'] = $total['mar']+$valores;
                                                        }elseif($mes==4){
                                                            $total['abr'] = $total['abr']+$valores;
                                                        }elseif($mes==5){
                                                            $total['mai'] = $total['mai']+$valores;
                                                        }elseif($mes==6){
                                                            $total['jun'] = $total['jun']+$valores;
                                                        }elseif($mes==7){
                                                            $total['jul'] = $total['jul']+$valores;
                                                        }elseif($mes==8){
                                                            $total['ago'] = $total['ago']+$valores;
                                                        }
                                                        /* fim calculos*/
                                                        ?>
                                                        <td>{{number_format($valores,2,',','.')}} Akz</td>
                                                        <?php }?>
                                                    </tr>
                                                <?php } ?>

                                                <tr>
                                                    <th>TOTAL</th>

                                                <th>{{number_format($total['set'],2,',', '.')}}</th>
                                                    <th>{{number_format($total['out'],2,',', '.')}}</th>
                                                    <th>{{number_format($total['nov'],2,',', '.')}}</th>
                                                    <th>{{number_format($total['dez'],2,',', '.')}}</th>
                                                    <th>{{number_format($total['jan'],2,',', '.')}}</th>
                                                    <th>{{number_format($total['fev'],2,',', '.')}}</th>
                                                    <th>{{number_format($total['mar'],2,',', '.')}}</th>
                                                    <th>{{number_format($total['abr'],2,',', '.')}}</th>
                                                    <th>{{number_format($total['mai'],2,',', '.')}}</th>
                                                    <th>{{number_format($total['jun'],2,',', '.')}}</th>
                                                    <th>{{number_format($total['jul'],2,',', '.')}}</th>
                                                    <th>{{number_format($total['ago'],2,',', '.')}}</th>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="grafico">
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
                                        </div>

                                    </p>
                                </div>
                                <div class="tab-pane" id="messages5" role="tabpanel">
                                    <p class="m-0">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" style="font-size:12px;">
                                                <thead>
                                                    <tr>
                                                        <th>Tipos de Pagamentos</th>
                                                        <th>{{$getAno}}</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach($getTipoPagamentos as $tipo_pagamentos){
                                                    ?>
                                                    <tr>
                                                    <td>{{$tipo_pagamentos->tipo}}</td>
                                                    <?php
                                                        $valores = ControladorStatic::getValoresBalancoAnual($tipo_pagamentos->id, $getAno);
                                                    ?>
                                                        <td>{{number_format($valores,2,',','.')}} Akz</td>
                                                    <?php ?>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
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
<div class="btnPesquisar">
        <div class="btnPesquisarBtn">
            <a href="/mapas/balancos" class="btn btn-primary btnCircular btnPrincipal" title="Voltar"><i class="ti-arrow-left"></i></a>
        </div>
    </div>
<!-- end-->

@endsection

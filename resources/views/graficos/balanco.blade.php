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
                    <h5>{{$submenu}}</h5>
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
                  
                   <figure class="highcharts-figure">
                    <div id="container"></div>
                    
                </figure>
                
                
                
                        <script type="text/javascript">
                Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Balanço Referente ao ano de {{$getAno}}'
                    },
                    subtitle: {
                        text: 'Source: okusoleka.com'
                    },
                    xAxis: {
                        categories: [
                           <?php
                                foreach($getEpocasPagamento as $epocas){
                            ?>
                                '{{$epocas->epoca}}',
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
                                foreach($getEpocasPagamento as $epocas){
                                $valores = ControladorStatic::getValoresBalanco($epocas->epoca, $tipo_pagamentos->id, $getAno);
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
            </div>
        </div>
    </div>
    
</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->


@endsection
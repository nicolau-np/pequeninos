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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Balanço Mensal {{$getAno}}</title>
</head>
<body>
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
</body>
</html>

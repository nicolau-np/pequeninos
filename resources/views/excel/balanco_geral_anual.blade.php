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
    <title>Balanço Anual {{$getAno}}</title>
</head>
<body>
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
</body>
</html>

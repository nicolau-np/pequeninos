<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$getHistorico->estudante->pessoa->nome}}</title>
    <style>
        @page{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="desc_empresa">
           <p>CABECALHO </p>
        </div>
    </div>

    <div class="header-body">
        <p style="text-align: center;">Comprovativo de Pagamento referente a {{$getTipoPagamento->tipo}}</p>
    <p>Fatura Nº {{$getNumeroFatura}}</p>
    </div>

   <div class="body">
       @if ($getId_tipo_pagamento == 3)
             <div class="tableComparticipacao">
                <table border="1">
                    <thead>
                        <tr>
                        <th>Encarregado</th>
                        <th>Educandos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>{{$getHistorico->estudante->encarregado->pessoa->nome}}</td>
                        <td>
                            @foreach ($getEducandos as $educandos)
                                {{$educandos->pessoa->nome}}<br/>
                            @endforeach
                        </td>
                       </tr>
                     
                    </tbody>
                </table>

                <hr/>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Epoca</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $created_at = null;
                        
                        foreach ($getPagamento as $pagamento){
                        $created_at = $pagamento->created_at;
                        $total = $total + $pagamento->preco;
                        ?>
                            <tr>
                            <td>{{$pagamento->epoca}}</td>
                            <td>{{number_format($pagamento->preco,2,',','.')}} Akz</td>
                            </tr>
                        <?php }?>
                       
                    </tbody>
                </table>
                <p>
                    Total Pago: {{number_format($total,2,',','.')}} Akz&nbsp;&nbsp;&nbsp; Data: {{date('d-m-Y', strtotime($created_at))}} {{date('H:s:i', strtotime($created_at))}}
                </p>
            </div>

        @else
        <div class="tablePagamento">
            <table border="1">
                <thead>
                    <tr>
                        <th>Epoca</th>
                        <th>Valor (Akz)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $created_at = null;
                    
                    foreach ($getPagamento as $pagamento){
                    $created_at = $pagamento->created_at;
                    $total = $total + $pagamento->preco;
                    ?>
                        <tr>
                        <td>{{$pagamento->epoca}}</td>
                        <td>{{number_format($pagamento->preco,2,',','.')}}</td>
                        </tr>
                    <?php }?>
                   
                </tbody>
            </table>
            <p>
                Total Pago: {{number_format($total,2,',','.')}} Akz&nbsp;&nbsp;&nbsp; Data: {{date('d-m-Y', strtotime($created_at))}} {{date('H:s:i', strtotime($created_at))}}
            </p>
        </div>
       @endif
    </div>
</body>
</html>
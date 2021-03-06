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
        .header{
            display: block;
        }
        .desc_empresa{
            float: left;
        }
        .desc_cliente{
            float: right;
            border: 1px solid #333;
            padding: 4px;
            width: 300px;
        }
        .rodape{
            display: block;
        }
        .encarregado{
            float: left;
            text-align: center;
        }
        .secretaria{
            float: right;
            text-align: center;
        }
        .linha_divisoria{
            text-align: center;
        }
        .tabela1{
            background-color: #f5f5f5;
        }
        .tr_especial{
            background-color: #f5f5f5;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="desc_empresa">
        <p>
               <span style="font-weight: bold;">COMPLEXO ESCOLAR LAR DOS PEQUENINOS <BR/>
               DAS IRMÃS DO SANTÍSSIMO SALVADOR-HUAMBO</span><BR/>
               NIF: 5121019874<BR/>
        </p>
        </div>
        <div class="desc_cliente">
            <p>
              Exmo Sr(a).  <BR/>
              <span style="font-weight: bold;">
                {{$getHistorico->estudante->encarregado->pessoa->nome}}<br/>
                HUAMBO-ANGOLA
              </span>
            </p>
            
        </div>
        <br/><br/><br/><br/>
    </div>

    <div class="header-body">
        <br/><br/><br/><br/>
        <table border=1 cellspacing=0 cellpadding=2 bordercolor="#000" class="tabela1">
            <tr>
                <td colspan="2">PAGAMENTO DE {{strtoupper($getTipoPagamento->tipo)}}</td>
            </tr>
            <tr>
                <td>Fact. Nº {{date('dmY', strtotime($getFatura->data_fatura))}}{{$getFatura->id}}</td>
            <td>Data: {{date('d-m-Y', strtotime($getFatura->data_fatura))}} {{date('H:i:s', strtotime($getFatura->created_at))}}</td>
            </tr>
        </table>
    </div>

   <div class="body">
       @if ($getId_tipo_pagamento == 3)
             <div class="tableComparticipacao">
                <table border=1 cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 60%">
                    <thead>
                        <tr class="tr_especial">
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

                <br/>
                <table border=1 cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 60%;">
                    <thead>
                        <tr class="tr_especial">
                            <th>Epoca</th>
                            <th>Valor(Akz)</th>
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
                <p style="font-size:14px;">
                    Total Geral: {{number_format($total,2,',','.')}} Akz
                </p>
            </div>

        @else
        <div class="tablePagamento">
            <table border=1 cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%">
                <tr class="tr_especial">
                    <td>Nº Processo</td>
                    <td>Nome completo</td>
                    <td>Classe</td>
                    <td>Turma</td>
                    <td>Turno</td>
                </tr>
                <tr>
                <td>{{$getHistorico->id_estudante}}</td>
                <td>{{$getHistorico->estudante->pessoa->nome}}</td>
                <td>{{$getHistorico->turma->classe->classe}}</td>
                <td>{{$getHistorico->turma->turma}}</td>
                <td>{{$getHistorico->turma->turno->turno}}</td>
                </tr>
            </table>
            <br/>
            <table border=1 cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 60%;">
                <thead>
                    <tr class="tr_especial">
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
            <p style="font-size:14px;">
                Total Geral: {{number_format($total,2,',','.')}} Akz
            </p>
        </div>
       @endif
    </div>
    <div class="rodape">
        <div class="encarregado">
            Encarregado<br/>
        ________________________
        </div>
        <div class="secretaria">
            Secretaria<br/>
            ______________________
        </div>
    </div>
    <div class="linha_divisoria">
        <br/><br/>
        <p>
            -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        </p>
     </div>
    




     <div class="header">
        <div class="desc_empresa">
        <p>
               <span style="font-weight: bold;">COMPLEXO ESCOLAR LAR DOS PEQUENINOS <BR/>
               DAS IRMÃS DO SANTÍSSIMO SALVADOR-HUAMBO</span><BR/>
               NIF: 5121019874<BR/>
        </p>
        </div>
        <div class="desc_cliente">
            <p>
              Exmo Sr(a).  <BR/>
              <span style="font-weight: bold;">
                {{$getHistorico->estudante->encarregado->pessoa->nome}}<br/>
                HUAMBO-ANGOLA
              </span>
            </p>
            
        </div>
        <br/><br/><br/><br/>
    </div>

    <div class="header-body">
        <br/><br/><br/><br/>
        <table border=1 cellspacing=0 cellpadding=2 bordercolor="#000" class="tabela1">
            <tr>
                <td colspan="2">PAGAMENTO DE {{strtoupper($getTipoPagamento->tipo)}}</td>
            </tr>
            <tr>
                <td>Fact. Nº {{date('dmY', strtotime($getFatura->data_fatura))}}{{$getFatura->id}}</td>
            <td>Data: {{date('d-m-Y', strtotime($getFatura->data_fatura))}} {{date('H:i:s', strtotime($getFatura->created_at))}}</td>
            </tr>
        </table>
    </div>

   <div class="body">
       @if ($getId_tipo_pagamento == 3)
             <div class="tableComparticipacao">
                <table border=1 cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 60%">
                    <thead>
                        <tr class="tr_especial">
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

                <br/>
                <table border=1 cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 60%;">
                    <thead>
                        <tr class="tr_especial">
                            <th>Epoca</th>
                            <th>Valor(Akz)</th>
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
                <p style="font-size:14px;">
                    Total Geral: {{number_format($total,2,',','.')}} Akz
                </p>
            </div>

        @else
        <div class="tablePagamento">
            <table border=1 cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%">
                <tr class="tr_especial">
                    <td>Nº Processo</td>
                    <td>Nome completo</td>
                    <td>Classe</td>
                    <td>Turma</td>
                    <td>Turno</td>
                </tr>
                <tr>
                <td>{{$getHistorico->id_estudante}}</td>
                <td>{{$getHistorico->estudante->pessoa->nome}}</td>
                <td>{{$getHistorico->turma->classe->classe}}</td>
                <td>{{$getHistorico->turma->turma}}</td>
                <td>{{$getHistorico->turma->turno->turno}}</td>
                </tr>
            </table>
            <br/>
            <table border=1 cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 60%;">
                <thead>
                    <tr class="tr_especial">
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
            <p style="font-size:14px;">
                Total Geral: {{number_format($total,2,',','.')}} Akz
            </p>
        </div>
       @endif
    </div>
    <div class="rodape">
        <div class="encarregado">
            Encarregado<br/>
        ________________________
        </div>
        <div class="secretaria">
            Secretaria<br/>
            ______________________
        </div>
    </div>


    </body>
</html>
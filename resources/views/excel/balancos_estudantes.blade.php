<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="titulo">
        <p style="text-align: center; font-weight:bold; font-size:15px;">BALANÇO COMPARTICIPAÇÃO MENSAL</p>
    </div>
    <div class="mini-cabecalho">
        <div class="ano_curso">
           De: {{date('d/m/Y', strtotime($data1))}}<br/>
           Até: {{ date('d/m/Y', strtotime($data2)) }}
        </div>

    </div>

    <div>
        <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th>Nome Completo</th>
                    <th>Gênero</th>
                    <th>Turma</th>
                    <th>Valor Pago</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($getPagamentos as $pagamento)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            {{date('d/m/Y', strtotime($pagamento->data_pagamento))}}
                        </td>
                        <td>{{$pagamento->estudante->pessoa->nome}}</td>
                        <td>{{$pagamento->estudante->pessoa->genero}}</td>
                        <td>{{$pagamento->estudante->turma->turma}}</td>
                        <td>{{number_format($pagamento->preco,2,',','.')}}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div>
        TOTAL: {{number_format($getPagamentos->sum('preco'),2,',','.')}}
    </div>
</body>
</html>

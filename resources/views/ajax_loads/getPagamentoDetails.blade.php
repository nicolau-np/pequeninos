Numero da Fatura {{$getPagamentoDetails->fatura}}<br/>
Data de Pagamento: {{date('d-m-Y', strtotime($getPagamentoDetails->data_pagamento))}}<br/>
Usuário: {{$getPagamentoDetails->usuario->username}}<br/><br/>
<a href="/relatorios/fatura/{{$getPagamentoDetails->fatura}}" class="btn btn-primary">Gerar Fatura</a>
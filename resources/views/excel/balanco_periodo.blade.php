@php
use App\Http\Controllers\ControladorStatic;

@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Balanço Diário</title>
</head>
<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipo de Pagamento</th>
                <th>Valor</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($getTipoPagamentos as $tipo_pagamentos)
                <tr>
                    <td>{{ $tipo_pagamentos->tipo }}</td>
                    <td>
                        @php
                            $total = 0;
                            $pagamento_diario = ControladorStatic::getBalanco($data1, $data2, $tipo_pagamentos->id);
                            foreach ($pagamento_diario as $pag_diario) {
                                $total = $total + $pag_diario->preco;
                            }
                        @endphp
                        {{ number_format($total, 2, ',', '.') }} Akz
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>
</body>
</html>

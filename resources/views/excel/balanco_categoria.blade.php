@php
use App\Http\Controllers\ControladorStatic;

@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Balanco por Categoria {{$getAno}}</title>
</head>
<body>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Tipos de Pagamentos</th>
                @foreach ($getCategorias as $categorias)
                    <th style="text-align: center;">
                        {{ $categorias->sigla }}
                    </th>
                @endforeach

            </tr>
        </thead>
        <tbody>
            @foreach ($getTipoPagamentos as $tipo_pagamentos)
                @php
                    $total = 0;
                @endphp
                <tr>
                    <td>{{ $tipo_pagamentos->tipo }}</td>
                    @foreach ($getCategorias as $categorias)
                        @php
                            $total = 0;
                            $getValores = ControladorStatic::getTotalValoresCategoria($getAno, $tipo_pagamentos->id, $categorias->sigla);
                            foreach ($getValores as $valores) {
                                $total = $total + $valores->preco;
                            }
                        @endphp
                        <td>{{ number_format($total, 2, ',', '.') }}</td>
                    @endforeach


                </tr>
            @endforeach
            <tr>
                <th>TOTAL</th>
                @foreach ($getCategorias as $categorias)

                    @php
                        $totalCategoria = 0;

                        $getValoresTCategoria = ControladorStatic::getValoresTotalCategoria($getAno, $categorias->sigla);
                        foreach ($getValoresTCategoria as $valoresCategoria) {
                            $totalCategoria = $totalCategoria + $valoresCategoria->preco;

                        }
                    @endphp
                    <th>{{ number_format($totalCategoria, 2, ',', '.') }}</th>
                @endforeach

            </tr>
        </tbody>
    </table>
</body>
</html>

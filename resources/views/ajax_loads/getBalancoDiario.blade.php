@php
use App\Http\Controllers\ControladorStatic;
@endphp

<div>
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
</div>

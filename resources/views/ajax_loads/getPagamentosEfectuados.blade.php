@php
use App\Http\Controllers\ControladorStatic;
@endphp
<div class="list">
    <h4>Pagamentos Efectuados em: {{ date('d-m-Y', strtotime($getData)) }}</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Estudante</th>
                <th>Turma</th>
                <th>Pagamentos Efectuados</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($getPagamentosEfectuados as $pags_efectuados)

                <tr>
                    <td style="font-weight: bold;">{{ $pags_efectuados->pessoa->nome }}</td>
                    <td>{{ $pags_efectuados->turma->turma }}</td>
                    <td>
                        @php
                            $pagamentos = ControladorStatic::getPagamentosEfectuados($pags_efectuados->id, $getData);

                        @endphp

                        @foreach ($pagamentos as $pags)
                            <a class="corrigir_pagamentos" data-id_tipo_pagamento="{{ $pags->id_tipo_pagamento }}"
                                data-id_estudante="{{ $pags_efectuados->id }}" data-factura="{{ $pags->fatura }}"
                                data-ano_lectivo="{{ $pags->ano_lectivo }}" href="#">Fact: {{ $pags->fatura }} =>
                                <b>{{ $pags->epoca }}</b></a><br />
                        @endforeach
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>


    <!-- delete modal-->
    <div class="modal fade" id="deletemodal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    {{ Form::open(['method' => 'post', 'class' => 'form', 'url' => '/pagamentos/destroy']) }}
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <p style="text-align: center; font-size:18px;">
                                Tem a certeza que deseja Eliminar o Pagamento
                                ??
                            </p>
                            <input type="hidden" class="id_tipo_pagamento" name="id_tipo_pagamento" />
                            <input type="hidden" class="id_estudante" name="id_estudante" />
                            <input type="hidden" class="factura" name="factura" />
                            <input type="hidden" class="ano_lectivo" name="ano_lectivo" />
                        </div>
                        <br /><br /><br />
                        <div class="col-md-12" style="text-align: center;">
                            {{ Form::submit('SIM', ['class' => 'btn btn-primary']) }}&nbsp;&nbsp;
                            {{ Form::reset('NÃO', ['class' => 'btn btn-danger cancel']) }}
                        </div>
                    </div>
                    {{ Form::close() }}

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--end-->


    <script>
        $(document).ready(function() {
            $('.corrigir_pagamentos').click(function(e) {
                e.preventDefault();
                var data = {
                    id_tipo_pagamento: $(this).data('id_tipo_pagamento'),
                    id_estudante: $(this).data('id_estudante'),
                    factura: $(this).data('factura'),
                    ano_lectivo: $(this).data('ano_lectivo'),
                    _token: "{{ csrf_token() }}"
                };

                $('.id_tipo_pagamento').val(data.id_tipo_pagamento);
                $('.id_estudante').val(data.id_estudante);
                $('.factura').val(data.factura);
                $('.ano_lectivo').val(data.ano_lectivo);
                $('#deletemodal').modal('show');
            });
        });

    </script>
</div>

Numero da Fatura {{ $getPagamentoDetails->fatura }}<br />
Data de Pagamento: {{ date('d-m-Y', strtotime($getPagamentoDetails->data_pagamento)) }}<br />
Usuário: {{ $getPagamentoDetails->usuario->username }}<br /><br />
<a href="/relatorios/fatura/{{ $getPagamentoDetails->fatura }}" class="btn btn-primary">Gerar Fatura</a>

&nbsp;&nbsp;
<a data-factura="{{ $getPagamentoDetails->fatura }}" data-ano_lectivo="{{ $getPagamentoDetails->ano_lectivo }}" href="#" class="btn btn-danger corrigirpagamento">Corrigir
    Pagamento</a>


<!-- modal -->
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
<!-- fim modal -->
<script>
    $(document).ready(function() {
        $('.corrigirpagamento').click(function(e) {
            e.preventDefault();
            var data = {
                factura: $(this).data('factura'),
                ano_lectivo:$(this).data('ano_lectivo'),
                _token: "{{ csrf_token() }}"
            };

            $('.factura').val(data.factura);
            $('.ano_lectivo').val(data.ano_lectivo);
            $('#deletemodal').modal('show');

        });

        $('.cancel').click(function(e) {
            e.preventDefault();
            $('#deletemodal').modal('hide');
        });
    });

</script>

Numero da Fatura {{ $getPagamentoDetails->fatura }}<br />
Data de Pagamento: {{ date('d-m-Y', strtotime($getPagamentoDetails->data_pagamento)) }}<br />
Usuário: {{ $getPagamentoDetails->usuario->username }}<br />
<span style="font-weight: bold;">
    {{ $getPagamentoDetails->descricao }}
</span>
<hr/>
<a href="/relatorios/fatura/{{ $getPagamentoDetails->fatura }}" class="btn btn-primary">Gerar Fatura</a>
&nbsp;&nbsp;
<a data-descricao = "{{$getPagamentoDetails->descricao}}" data-data_pagamento = "{{$getPagamentoDetails->data_pagamento}}" data-id_tipo_pagamento="{{$getPagamentoDetails->id_tipo_pagamento}}" data-id_estudante="{{$getPagamentoDetails->id_estudante}}" data-factura="{{ $getPagamentoDetails->fatura }}" data-ano_lectivo="{{ $getPagamentoDetails->ano_lectivo }}" href="#" class="btn btn-success editarPagamento">Editar</a>
&nbsp;&nbsp;
<a data-id_tipo_pagamento="{{$getPagamentoDetails->id_tipo_pagamento}}" data-id_estudante="{{$getPagamentoDetails->id_estudante}}" data-factura="{{ $getPagamentoDetails->fatura }}" data-ano_lectivo="{{ $getPagamentoDetails->ano_lectivo }}" href="#" class="btn btn-danger corrigirpagamento">Corrigir
    Pagamento</a>


<!-- modal -->
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
<!--editar modal-->
<div class="modal fade" id="editemodal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                {{ Form::open(['method' => 'post', 'class' => 'form', 'url' => '/pagamentos/update']) }}
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('data_pagamento',"Data de Pagamento")}} <span class="text-danger">*</span>
                        {{Form::date('data_pagamento', null, ['class' =>"form-control data_pagamento2", 'placeholder'=>"Data de Pagamento"])}}
                    </div>

                    <div class="col-md-12">
                        <br />
                        {{Form::label('descricao',"Descriçao")}} <span class="text-danger">*</span>
                        {{Form::text('descricaoT', null, ['class' =>"form-control descricao2", 'placeholder'=>"Data de Pagamento"])}}
                    </div>

                    <div class="col-md-12">

                        <input type="hidden" class="id_tipo_pagamento2" name="id_tipo_pagamento" />
                        <input type="hidden" class="id_estudante2" name="id_estudante" />
                        <input type="hidden" class="factura2" name="factura" />
                        <input type="hidden" class="ano_lectivo2" name="ano_lectivo" />
                    </div>
                    <br /><br />
                    <div class="col-md-12" style="text-align: center;">
                        {{ Form::submit('SALVAR', ['class' => 'btn btn-primary btn-block']) }}&nbsp;&nbsp;

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
<!-- fim modal -->
<script>
    $(document).ready(function() {
        $('.corrigirpagamento').click(function(e) {
            e.preventDefault();
            var data = {
                id_tipo_pagamento:$(this).data('id_tipo_pagamento'),
                id_estudante:$(this).data('id_estudante'),
                factura: $(this).data('factura'),
                ano_lectivo:$(this).data('ano_lectivo'),
                _token: "{{ csrf_token() }}"
            };

            $('.id_tipo_pagamento').val(data.id_tipo_pagamento);
            $('.id_estudante').val(data.id_estudante);
            $('.factura').val(data.factura);
            $('.ano_lectivo').val(data.ano_lectivo);
            $('#deletemodal').modal('show');

        });

        $('.editarPagamento').click(function(e){
            e.preventDefault();
            var data = {
                descricao: $(this).data('descricao'),
                data_pagamento: $(this).data('data_pagamento'),
                id_tipo_pagamento:$(this).data('id_tipo_pagamento'),
                id_estudante:$(this).data('id_estudante'),
                factura: $(this).data('factura'),
                ano_lectivo:$(this).data('ano_lectivo'),
                _token: "{{ csrf_token() }}"
            };

            $('.descricao2').val(data.descricao);
            $('.data_pagamento2').val(data.data_pagamento);
            $('.id_tipo_pagamento2').val(data.id_tipo_pagamento);
            $('.id_estudante2').val(data.id_estudante);
            $('.factura2').val(data.factura);
            $('.ano_lectivo2').val(data.ano_lectivo);
            $('#editemodal').modal('show');
        });

        $('.cancel').click(function(e) {
            e.preventDefault();
            $('#deletemodal').modal('hide');
        });
    });

</script>

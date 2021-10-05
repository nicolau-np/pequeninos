@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}</h5>
                    <span></span>
                    <div class="card-header-right">

                        <ul class="list-unstyled card-option" style="width: 35px;">
                            <li class=""><i class="icofont icofont-simple-left"></i></li>
                            <li><i class="icofont icofont-maximize full-card"></i></li>
                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div class="form">
                        @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                        {{Form::open(['class'=>"form_search", 'method'=>"post", 'url'=>"#"])}}
                        <div class="row text-right">
                            <div class="col-md-8">
                                {{Form::text('text_search', null, ['class'=>"form-control text_search", 'placeholder'=>"Pesquisar..."])}}
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-success btn-sm"><i class="ti-search"></i></button>
                            </div>
                            <div class="col-md-3">
                                <a href="/horarios/export" alt="Exportar Horário"><i class="ti-download"></i></a>&nbsp;&nbsp;
                                <a href="/horarios/import" alt="Importar Horário"><i class="ti-upload"></i></a>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>

                    <div class="table-responsive">
                        <br/>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Gênero</th>
                                    <th>Cargo</th>
                                    <th>Escalão</th>
                                    <th>Operações</th>
                                </tr>
                            </thead>
                            <tbody class="load_funcionarios">
                                @if($getFuncionarios->count()==0)
                                <span class="not_found">Nenhum funcionário cadastrado</span>
                                @else
                                @foreach ($getFuncionarios as $funcionarios)

                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$funcionarios->pessoa->nome}}</td>
                                    <td>{{$funcionarios->pessoa->genero}}</td>
                                    <td>{{$funcionarios->cargo->cargo}}</td>
                                    <td>{{$funcionarios->escalao->escalao}}</td>
                                    <td>
                                        <a href="/horarios/create/{{$funcionarios->id}}" class="btn btn-success btn-sm"><i class="ti-time"></i> Hora.</a>
                                        <a href="/funcionarios/edit/{{$funcionarios->id}}" class="btn btn-primary btn-sm"><i class="ti-pencil-alt"></i> Editar</a>
                                        <a href="#" data-id_funcionario="{{$funcionarios->id}}" data-nome_funcionario="{{$funcionarios->pessoa->nome}}" class="btn btn-danger btn-sm delete"><i class="ti-trash"></i> Eliminar</a>
                                    </td>
                                </tr>

                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">
                        {{$getFuncionarios->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->
<div class="btnPesquisar">
    <div class="btnPesquisarBtn">
		<a href="/funcionarios/export" class="btn btn-success btnCircular btnPrincipal" title="Exportar"><i class="ti-download"></i></a>
	</div>&nbsp;
    <div class="btnPesquisarBtn">
		<a href="/funcionarios/import" class="btn btn-warning btnCircular btnPrincipal" title="Importar"><i class="ti-upload"></i></a>
	</div>&nbsp;
	<div class="btnPesquisarBtn">
		<a href="/funcionarios/create" class="btn btn-primary btnCircular btnPrincipal" title="Novo"><i class="ti-plus"></i></a>
	</div>
</div>

<!-- modal -->
<div class="modal fade" id="deletemodal">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-body">
          {{Form::open(['method'=>"post",'class'=>'form', 'url'=>"/funcionarios/destroy"])}}
          @csrf
          <div class="row">
            <div class="col-md-12">
                <p style="text-align: center; font-size:18px;">
                    Tem a certeza que deseja Eliminar o(a) funcionário(a)
                    <b class="nome_funcionario" style="font-size:22px;"></b>
                    ??
                </p>
                <input type="hidden" class="id_funcionario" name="id_funcionario"/>
            </div>
            <br/><br/><br/>
            <div class="col-md-12" style="text-align: center;">
                {{Form::submit('SIM',['class'=>"btn btn-primary"])}}&nbsp;&nbsp;
                {{Form::reset('NÃO', ['class'=>"btn btn-danger cancel"])}}
            </div>
          </div>
          {{Form::close()}}

        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- fim modal -->

<script>
    $(document).ready(function(){
        $('.text_search').keyup(function(e){
            e.preventDefault();
            var data = {
                search_text: $(this).val(),
                _token: "{{ csrf_token() }}"
            };
            $.ajax({
                type: "post",
                url: "{{route('searchFuncionarios')}}",
                data: data,
                dataType: "html",
                success: function (response) {
                    $('.load_funcionarios').html(response);
                }
            });
        });


        $('.delete').click(function(e){
            e.preventDefault();
            var data ={
                id_funcionario: $(this).data('id_funcionario'),
                nome_funcionario: $(this).data('nome_funcionario'),
                _token: "{{ csrf_token() }}"
            };

            $('.id_funcionario').val(data.id_funcionario);
            $('.nome_funcionario').text(data.nome_funcionario);
            $('#deletemodal').modal('show');
        });

        $('.cancel').click(function(e){
            e.preventDefault();
            $('#deletemodal').modal('hide');
        });
    });
</script>


@endsection

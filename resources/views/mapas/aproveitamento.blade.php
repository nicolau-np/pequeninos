@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}
                        <i class="ti-angle-right"></i>
                        @foreach ($getAnos as $anos)
                        <a href="/mapas/aproveitamento/{{$anos->ano_lectivo}}" style="color:#4680ff;">{{$anos->ano_lectivo}}</a>
                        <i class="ti-angle-right"></i>
                        @endforeach
                    </h5>
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
                   <div class="row">
                       <div class="col-md-12">
                        @if(session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
                       </div>

                    <div class="col-md-12">
                        <div class="row">

                            @foreach ($getEnsinos as $ensinos)


                            <div class="col-md-5 col-xl-5">
                            <a href="#" class="aproveitamento" data-id_ensino="{{$ensinos->id}}" data-ano_lectivo="{{$getAno}}" style="text-decoration: none;">
                                <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="ti-check-box bg-c-pink card1-icon"></i>
                                <span class="text-c-blue f-w-600" style="font-size:13px;">{{$ensinos->ensino}}</span>
                                    <h4 style="font-size:17px;"> </h4>
                                    <div>
                                        <span class="f-left m-t-10 text-muted">
                                            <i class="text-c-pink f-16 ti-arrow-circle-right m-r-10"></i>Aproveitamento
                                        </span>
                                    </div>
                                </div>
                                </div>
                                </a>
                                </div>


                            @endforeach

                        </div>

                    </div>


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
		<a href="/mapas" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>


<!-- modal -->
<div class="modal fade" id="epocamodal">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-body">
          {{Form::open(['class'=>'form', 'url'=>"/relatorios/mapas_aproveitamentos"])}}
          @csrf
          <div class="row">
            <div class="col-md-12">
                {{Form::select('epoca', [
                    '1'=>"1º Trimestre",
                    '2'=>"2º Trimestre",
                    '3'=>"3º Trimestre",
                ], null, ['class'=>"form-control", 'placeholder'=>"Epoca"])}}
            </div>
            <br/><br/>
            <div class="col-md-12 loadCurso">
                {{Form::select('id_curso', [], null, ['class'=>"form-control changeCurso", 'placeholder'=>"Curso"])}}
            </div>
            <br/><br/>
            <div class="col-md-12">
                {{Form::text('ano_lectivo', null, ['class'=>"form-control ano_lectivo", 'placeholder'=>"Ano Lectivo"])}}
                <input type="hidden" name="id_ensino" class="id_ensino" />
            </div>
            </div>
            <hr/>
            <div class="row loadDisciplinas">

            </div>
            <hr/>
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                {{Form::submit('SEGUIR',['class'=>"btn btn-primary"])}}
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
    $('document').ready(function(e){
        $('.aproveitamento').click(function(e){
            e.preventDefault();
            var data = {
                id_ensino: $(this).data('id_ensino'),
                ano_lectivo: $(this).data('ano_lectivo')
            };
            $('.ano_lectivo').val(data.ano_lectivo);
            $('.id_ensino').val(data.id_ensino);
            loadCurso(data.id_ensino);
            $('#epocamodal').modal('show');
        });


        function loadCurso(id_ensino){
            var data ={
                id_ensino: id_ensino,
                _token: "{{csrf_token()}}"
            };
            $.ajax({
                type: "post",
                url: "{{route('getCursoEnsino')}}",
                data: data,
                dataType: "html",

                success: function (response) {
                    $('.loadCurso').html(response);
                }
            });
        }
    });
</script>
@endsection

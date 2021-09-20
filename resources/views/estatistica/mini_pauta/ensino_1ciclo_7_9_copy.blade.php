@extends('layouts.app')
@section('content')
<style>
.total{
    font-weight:bold;
    color: #4680ff;
}
.total_geral{
    font-weight:bold;
    font-size:13px;
    color: #4680ff;
}
.tabEstatistica thead tr{

}
.positiva{
    color:#fff;
    background: #4680ff;
}
.negativa{
    color:#fff;
    background:#b10930;
}
.lancamento{
    color:#fff;
    background:#387d14;
}

</style>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}} <i class="ti-angle-right"></i>
                        {{$getHorario->turma->turma}}<i class="ti-angle-right"></i>
                        {{$getHorario->disciplina->disciplina}}<i class="ti-angle-right"></i>
                        {{$getAno}}

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

                    hello
                </div>
            </div>
        </div>
    </div>

</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->


@endsection

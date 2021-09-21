<?php
use App\Http\Controllers\ControladorNotas;
$count_avaliados = 0;
?>
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2">-</th>
                                <th colspan="4">1º TRIMESTRE</th>
                                <th colspan="4">2º TRIMESTRE</th>
                                <th colspan="4">3º TRIMESTRE</th>
                                <th colspan="2">-</th>
                            </tr>
                            <tr>
                                <th>MAC1</th>
                                <th>NPP1</th>
                                <th>PT1</th>
                                <th>MT1</th>

                                <th>MAC2</th>
                                <th>NPP2</th>
                                <th>PT2</th>
                                <th>MT2</th>

                                <th>MAC3</th>
                                <th>NPP3</th>
                                <th>PT3</th>
                                <th>MT3</th>

                                <th>MFD</th>
                                <th>MF</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
                                <tr>
                                    <?php
                                        
                                        ?>
                                    <td>AVALIADOS</td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>POSITIVAS</td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>NEGATIVAS</td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>% POSITIVAS</td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>% NEGATIVAS</td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                </tr>


                            </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->


@endsection

<?php
use App\Http\Controllers\ControladorNotas;
$count_avaliados1 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_avaliados2 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_avaliados3 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_avaliadosf = [
    'mfd'=>0,
    'mf'=>0,
];

$count_positivas1 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_positivas2 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_positivas3 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_positivasf = [
    'mfd'=>0,
    'mf'=>0,
];

$percent_positivas1 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$percent_positivas2 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$percent_positivas3 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$percent_positivasf = [
    'mfd'=>0,
    'mf'=>0,
];

$count_negativas1 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_negativas2 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_negativas3 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$count_negativasf = [
    'mfd'=>0,
    'mf'=>0,
];

$percent_negativas1 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$percent_negativas2 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$percent_negativas3 = [
    'mac'=>0,
    'npp'=>0,
    'pt'=>0,
    'mt'=>0,
];

$percent_negativasf = [
    'mfd'=>0,
    'mf'=>0,
];


?>
@extends('layouts.app')
@section('content')
<style>
table{
    font-size:12px;
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
                                <th colspan="2">DADOS FINAIS</th>
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

                                    <td>AVALIADOS</td>

                                    <!-- primeiro trimeste-->
                                    <?php
                                    $trimestre1 = ControladorNotas::getNotasEstudantes($getAno, 1);
                                    foreach ($trimestre1 as $valor1){
                                    //lancados
                                    if($valor1->mac !=null){
                                    $count_avaliados1['mac']=$count_avaliados1['mac']+1;
                                    }

                                    if($valor1->npp !=null){
                                    $count_avaliados1['npp']=$count_avaliados1['npp']+1;
                                    }
                                    if($valor1->pt !=null){
                                    $count_avaliados1['pt']=$count_avaliados1['pt']+1;
                                    }

                                    if($valor1->mt !=null){
                                    $count_avaliados1['mt']=$count_avaliados1['mt']+1;
                                    }
                                   //end

                                //positivas
                                 if($valor1->mac >=10){
                                  $count_positivas1['mac']=$count_positivas1['mac']+1;
                                  }
                                  if($valor1->npp >=10){
                                 $count_positivas1['npp']=$count_positivas1['npp']+1;
                                 }
                                 if($valor1->pt >=10){
                                 $count_positivas1['pt']=$count_positivas1['pt']+1;
                                 }
                                if($valor1->mt >=10){
                                 $count_positivas1['mt']=$count_positivas1['mt']+1;
                                }
                               //end

                               //negativas
                               if($valor1->mac <=4.99 && $valor1->mac !=null){
                                  $count_negativas1['mac']=$count_negativas1['mac']+1;
                                  }
                                  if($valor1->npp <=4.99 && $valor1->npp !=null){
                                 $count_negativas1['npp']=$count_negativas1['npp']+1;
                                 }
                                 if($valor1->pt <=4.99 && $valor1->pt !=null){
                                 $count_negativas1['pt']=$count_negativas1['pt']+1;
                                 }
                                if($valor1->mt <=4.99 && $valor1->mt !=null){
                                 $count_negativas1['mt']=$count_negativas1['mt']+1;
                                }
                               //end

                                }
                                 ?>
                                                                <td>{{$count_avaliados1['mac']}}</td>
                                                                <td>{{$count_avaliados1['npp']}}</td>
                                                                <td>{{$count_avaliados1['pt']}}</td>
                                                                <td>{{$count_avaliados1['mt']}}</td>

                                                                <!-- end primeiro trimeste-->

                                                                <!-- segundo trimeste-->
                                                                <?php
                                                                    $trimestre2 = ControladorNotas::getNotasEstudantes($getAno, 2);
                                                                    foreach ($trimestre2 as $valor2){
                                                                        //lancados
                                                                        if($valor2->mac !=null){
                                                                            $count_avaliados2['mac']=$count_avaliados2['mac']+1;
                                                                        }

                                                                        if($valor2->npp !=null){
                                                                            $count_avaliados2['npp']=$count_avaliados2['npp']+1;
                                                                        }

                                                                        if($valor2->pt !=null){
                                                                            $count_avaliados2['pt']=$count_avaliados2['pt']+1;
                                                                        }

                                                                        if($valor2->mt !=null){
                                                                            $count_avaliados2['mt']=$count_avaliados2['mt']+1;
                                                                        }
                                                                        //end

                                                                        //positivas
                                                                        if($valor2->mac >=10){
                                                                            $count_positivas2['mac']=$count_positivas2['mac']+1;
                                                                        }

                                                                        if($valor2->npp >=10){
                                                                            $count_positivas2['npp']=$count_positivas2['npp']+1;
                                                                        }

                                                                        if($valor2->pt >=10){
                                                                            $count_positivas2['pt']=$count_positivas2['pt']+1;
                                                                        }

                                                                        if($valor2->mt >=10){
                                                                            $count_positivas2['mt']=$count_positivas2['mt']+1;
                                                                        }
                                                                        //end

                                //negativas
                               if($valor2->mac <=4.99 && $valor2->mac !=null){
                                  $count_negativas2['mac']=$count_negativas2['mac']+1;
                                  }
                                  if($valor2->npp <=4.99 && $valor2->npp !=null){
                                 $count_negativas2['npp']=$count_negativas2['npp']+1;
                                 }
                                 if($valor2->pt <=4.99 && $valor2->pt !=null){
                                 $count_negativas2['pt']=$count_negativas2['pt']+1;
                                 }
                                if($valor2->mt <=4.99 && $valor2->mt !=null){
                                 $count_negativas2['mt']=$count_negativas2['mt']+1;
                                }
                               //end
                                                                    }
                                                                    ?>
                                                                <td>{{$count_avaliados2['mac']}}</td>
                                                                <td>{{$count_avaliados2['npp']}}</td>
                                                                <td>{{$count_avaliados2['pt']}}</td>
                                                                <td>{{$count_avaliados2['mt']}}</td>

                                                                <!-- end segundo trimeste-->

                                                               <!-- terceiro trimeste-->
                                                               <?php
                                                               $trimestre3 = ControladorNotas::getNotasEstudantes($getAno, 3);
                                                               foreach ($trimestre3 as $valor3){
                                                                   //lancados
                                                                   if($valor3->mac !=null){
                                                                       $count_avaliados3['mac']=$count_avaliados3['mac']+1;
                                                                   }

                                                                   if($valor3->npp !=null){
                                                                       $count_avaliados3['npp']=$count_avaliados3['npp']+1;
                                                                   }

                                                                   if($valor3->pt !=null){
                                                                       $count_avaliados3['pt']=$count_avaliados3['pt']+1;
                                                                   }

                                                                   if($valor3->mt !=null){
                                                                       $count_avaliados3['mt']=$count_avaliados3['mt']+1;
                                                                   }
                                                                   //end


                                                                        //positivas
                                                                        if($valor3->mac >=10){
                                                                            $count_positivas3['mac']=$count_positivas3['mac']+1;
                                                                        }

                                                                        if($valor3->npp >=10){
                                                                            $count_positivas3['npp']=$count_positivas3['npp']+1;
                                                                        }

                                                                        if($valor3->pt >=10){
                                                                            $count_positivas3['pt']=$count_positivas3['pt']+1;
                                                                        }

                                                                        if($valor3->mt >=10){
                                                                            $count_positivas3['mt']=$count_positivas3['mt']+1;
                                                                        }
                                                                        //end
                                //negativas
                               if($valor3->mac <=4.99 && $valor3->mac !=null){
                                  $count_negativas3['mac']=$count_negativas3['mac']+1;
                                  }
                                  if($valor3->npp <=4.99 && $valor3->npp !=null){
                                 $count_negativas3['npp']=$count_negativas3['npp']+1;
                                 }
                                 if($valor3->pt <=4.99 && $valor3->pt !=null){
                                 $count_negativas3['pt']=$count_negativas3['pt']+1;
                                 }
                                if($valor3->mt <=4.99 && $valor3->mt !=null){
                                 $count_negativas3['mt']=$count_negativas3['mt']+1;
                                }
                               //end
                                                               }
                                                               ?>
                                                           <td>{{$count_avaliados3['mac']}}</td>
                                                           <td>{{$count_avaliados3['npp']}}</td>
                                                           <td>{{$count_avaliados3['pt']}}</td>
                                                           <td>{{$count_avaliados3['mt']}}</td>

                                                           <!-- end terceiro trimeste-->

                                                           <!-- finals -->
                                                           <?php
                                                               $finals = ControladorNotas::getNotasEstudantesFinal($getAno);
                                                               foreach ($finals as $valorf){
                                                                   //lancados
                                                                   if($valorf->mfd !=null){
                                                                       $count_avaliadosf['mfd']=$count_avaliadosf['mfd']+1;
                                                                   }

                                                                   if($valorf->mf !=null){
                                                                       $count_avaliadosf['mf']=$count_avaliadosf['mf']+1;
                                                                   }
                                                                   //end

                                                                //positivas
                                                                   if($valorf->mfd >=10){
                                                                       $count_positivasf['mfd']=$count_positivasf['mfd']+1;
                                                                   }

                                                                   if($valorf->mf >=10){
                                                                       $count_positivasf['mf']=$count_positivasf['mf']+1;
                                                                   }
                                                                   //end

                                                                   //negativas
                                                                   if($valorf->mfd <=4.99 && $valorf->mfd !=null){
                                                                       $count_negativasf['mfd']=$count_negativasf['mfd']+1;
                                                                   }

                                                                   if($valorf->mf <=4.99 && $valorf->mf !=null){
                                                                       $count_negativasf['mf']=$count_negativasf['mf']+1;
                                                                   }
                                                                   //end
                                                               }
                                                               ?>
                                                            <td>{{$count_avaliadosf['mfd']}}</td>
                                                            <td>{{$count_avaliadosf['mf']}}</td>
                                                            <!-- end finals-->
                                </tr>

                                <tr>
                                    <td>POSITIVAS</td>

                                    <td>{{$count_positivas1['mac']}}</td>
                                    <td>{{$count_positivas1['npp']}}</td>
                                    <td>{{$count_positivas1['pt']}}</td>
                                    <td>{{$count_positivas1['mt']}}</td>

                                    <td>{{$count_positivas2['mac']}}</td>
                                    <td>{{$count_positivas2['npp']}}</td>
                                    <td>{{$count_positivas2['pt']}}</td>
                                    <td>{{$count_positivas2['mt']}}</td>

                                    <td>{{$count_positivas3['mac']}}</td>
                                    <td>{{$count_positivas3['npp']}}</td>
                                    <td>{{$count_positivas3['pt']}}</td>
                                    <td>{{$count_positivas3['mt']}}</td>

                                    <td>{{$count_positivasf['mfd']}}</td>
                                    <td>{{$count_positivasf['mf']}}</td>
                                </tr>

                                <tr>
                                    <td>NEGATIVAS</td>

                                    <td>{{$count_negativas1['mac']}}</td>
                                    <td>{{$count_negativas1['npp']}}</td>
                                    <td>{{$count_negativas1['pt']}}</td>
                                    <td>{{$count_negativas1['mt']}}</td>

                                    <td>{{$count_negativas2['mac']}}</td>
                                    <td>{{$count_negativas2['npp']}}</td>
                                    <td>{{$count_negativas2['pt']}}</td>
                                    <td>{{$count_negativas2['mt']}}</td>

                                    <td>{{$count_negativas3['mac']}}</td>
                                    <td>{{$count_negativas3['npp']}}</td>
                                    <td>{{$count_negativas3['pt']}}</td>
                                    <td>{{$count_negativas3['mt']}}</td>

                                    <td>{{$count_negativasf['mfd']}}</td>
                                    <td>{{$count_negativasf['mf']}}</td>
                                </tr>

                                <tr>
                                    <?php
                                    //primeiro trimestre
                                    if($count_avaliados1['mac']==0){
                                        $percent_positivas1['mac']=0;
                                    }else{
                                        $percent_positivas1['mac'] = ($count_positivas1['mac']*100)/$count_avaliados1['mac'];
                                    }
                                    if($count_avaliados1['npp']==0){
                                        $percent_positivas1['npp']=0;
                                    }else{
                                        $percent_positivas1['npp'] = ($count_positivas1['npp']*100)/$count_avaliados1['npp'];
                                    }
                                    if($count_avaliados1['pt']==0){
                                        $percent_positivas1['pt']=0;
                                    }else{
                                        $percent_positivas1['pt'] = ($count_positivas1['pt']*100)/$count_avaliados1['pt'];
                                    }
                                    if($count_avaliados1['mt']==0){
                                        $percent_positivas1['mt']=0;
                                    }else{
                                        $percent_positivas1['mt'] = ($count_positivas1['mt']*100)/$count_avaliados1['mt'];
                                    }

                                    //end primeiro trimestre

                                    //segundo trimestre
                                    if($count_avaliados2['mac']==0){
                                        $percent_positivas2['mac']=0;
                                    }else{
                                        $percent_positivas2['mac'] = ($count_positivas2['mac']*100)/$count_avaliados2['mac'];
                                    }
                                    if($count_avaliados2['npp']==0){
                                        $percent_positivas2['npp']=0;
                                    }else{
                                        $percent_positivas2['npp'] = ($count_positivas2['npp']*100)/$count_avaliados2['npp'];
                                    }
                                    if($count_avaliados2['pt']==0){
                                        $percent_positivas2['pt']=0;
                                    }else{
                                        $percent_positivas2['pt'] = ($count_positivas2['pt']*100)/$count_avaliados2['pt'];
                                    }
                                    if($count_avaliados2['mt']==0){
                                        $percent_positivas2['mt']=0;
                                    }else{
                                        $percent_positivas2['mt'] = ($count_positivas2['mt']*100)/$count_avaliados2['mt'];
                                    }

                                    //end segundo trimestre

                                    //terceiro trimestre
                                    if($count_avaliados3['mac']==0){
                                        $percent_positivas3['mac']=0;
                                    }else{
                                    $percent_positivas3['mac'] = ($count_positivas3['mac']*100)/$count_avaliados3['mac'];
                                    }
                                    if($count_avaliados3['npp']==0){
                                        $percent_positivas3['npp']=0;
                                    }else{
                                    $percent_positivas3['npp'] = ($count_positivas3['npp']*100)/$count_avaliados3['npp'];
                                    }
                                    if($count_avaliados3['pt']==0){
                                        $percent_positivas3['pt']=0;
                                    }else{
                                    $percent_positivas3['pt'] = ($count_positivas3['pt']*100)/$count_avaliados3['pt'];
                                    }
                                    if($count_avaliados3['mt']==0){
                                        $percent_positivas3['mt']=0;
                                    }else{
                                    $percent_positivas3['mt'] = ($count_positivas3['mt']*100)/$count_avaliados3['mt'];
                                    }

                                    //end terceiro trimestre

                                    //terceiro trimestre
                                    if($count_avaliadosf['mfd']==0){
                                        $percent_positivasf['mfd'] = 0;
                                    }else{
                                        $percent_positivasf['mfd'] = ($count_positivasf['mfd']*100)/$count_avaliadosf['mfd'];
                                    }

                                    if($count_avaliadosf['mf']==0){
                                        $percent_positivasf['mf'] = 0;
                                    }else{
                                        $percent_positivasf['mf'] = ($count_positivasf['mf']*100)/$count_avaliadosf['mf'];
                                    }


                                    //end terceiro trimestre
                                        ?>
                                    <td>% POSITIVAS</td>

                                    <td>{{round($percent_positivas1['mac'],2)}}%</td>
                                    <td>{{round($percent_positivas1['npp'],2)}}%</td>
                                    <td>{{round($percent_positivas1['pt'],2)}}%</td>
                                    <td>{{round($percent_positivas1['mt'],2)}}%</td>

                                    <td>{{round($percent_positivas2['mac'],2)}}%</td>
                                    <td>{{round($percent_positivas2['npp'],2)}}%</td>
                                    <td>{{round($percent_positivas2['pt'],2)}}%</td>
                                    <td>{{round($percent_positivas2['mt'],2)}}%</td>

                                    <td>{{round($percent_positivas3['mac'],2)}}%</td>
                                    <td>{{round($percent_positivas3['npp'],2)}}%</td>
                                    <td>{{round($percent_positivas3['pt'],2)}}%</td>
                                    <td>{{round($percent_positivas3['mt'],2)}}%</td>

                                    <td>{{round($percent_positivasf['mfd'],2)}}%</td>
                                    <td>{{round($percent_positivasf['mf'],2)}}%</td>
                                </tr>

                                <tr>
                                    <?php
                                    //primeiro trimestre
                                    if($count_avaliados1['mac']==0){
                                        $percent_negativas1['mac']=0;
                                    }else{
                                        $percent_negativas1['mac'] = ($count_negativas1['mac']*100)/$count_avaliados1['mac'];
                                    }
                                    if($count_avaliados1['npp']==0){
                                        $percent_negativas1['npp']=0;
                                    }else{
                                        $percent_negativas1['npp'] = ($count_negativas1['npp']*100)/$count_avaliados1['npp'];
                                    }
                                    if($count_avaliados1['pt']==0){
                                        $percent_negativas1['pt']=0;
                                    }else{
                                        $percent_negativas1['pt'] = ($count_negativas1['pt']*100)/$count_avaliados1['pt'];
                                    }
                                    if($count_avaliados1['mt']==0){
                                        $percent_negativas1['mt']=0;
                                    }else{
                                        $percent_negativas1['mt'] = ($count_negativas1['mt']*100)/$count_avaliados1['mt'];
                                    }

                                    //end primeiro trimestre

                                    //segundo trimestre
                                    if($count_avaliados2['mac']==0){
                                        $percent_negativas2['mac']=0;
                                    }else{
                                        $percent_negativas2['mac'] = ($count_negativas2['mac']*100)/$count_avaliados2['mac'];
                                    }
                                    if($count_avaliados2['npp']==0){
                                        $percent_negativas2['npp']=0;
                                    }else{
                                        $percent_negativas2['npp'] = ($count_negativas2['npp']*100)/$count_avaliados2['npp'];
                                    }
                                    if($count_avaliados2['pt']==0){
                                        $percent_negativas2['pt']=0;
                                    }else{
                                        $percent_negativas2['pt'] = ($count_negativas2['pt']*100)/$count_avaliados2['pt'];
                                    }
                                    if($count_avaliados2['mt']==0){
                                        $percent_negativas2['mt']=0;
                                    }else{
                                        $percent_negativas2['mt'] = ($count_negativas2['mt']*100)/$count_avaliados2['mt'];
                                    }

                                    //end segundo trimestre

                                    //terceiro trimestre
                                    if($count_avaliados3['mac']==0){
                                        $percent_negativas3['mac']=0;
                                    }else{
                                    $percent_negativas3['mac'] = ($count_negativas3['mac']*100)/$count_avaliados3['mac'];
                                    }
                                    if($count_avaliados3['npp']==0){
                                        $percent_negativas3['npp']=0;
                                    }else{
                                    $percent_negativas3['npp'] = ($count_negativas3['npp']*100)/$count_avaliados3['npp'];
                                    }
                                    if($count_avaliados3['pt']==0){
                                        $percent_negativas3['pt']=0;
                                    }else{
                                    $percent_negativas3['pt'] = ($count_negativas3['pt']*100)/$count_avaliados3['pt'];
                                    }
                                    if($count_avaliados3['mt']==0){
                                        $percent_negativas3['mt']=0;
                                    }else{
                                    $percent_negativas3['mt'] = ($count_negativas3['mt']*100)/$count_avaliados3['mt'];
                                    }

                                    //end terceiro trimestre

                                    //terceiro trimestre
                                    if($count_avaliadosf['mfd']==0){
                                        $percent_negativasf['mfd'] = 0;
                                    }else{
                                        $percent_negativasf['mfd'] = ($count_negativasf['mfd']*100)/$count_avaliadosf['mfd'];
                                    }

                                    if($count_avaliadosf['mf']==0){
                                        $percent_negativasf['mf'] = 0;
                                    }else{
                                        $percent_negativasf['mf'] = ($count_negativasf['mf']*100)/$count_avaliadosf['mf'];
                                    }


                                    //end terceiro trimestre
                                        ?>
                                    <td>% NEGATIVAS</td>

                                    <td>{{round($percent_negativas1['mac'],2)}}%</td>
                                    <td>{{round($percent_negativas1['npp'],2)}}%</td>
                                    <td>{{round($percent_negativas1['pt'],2)}}%</td>
                                    <td>{{round($percent_negativas1['mt'],2)}}%</td>

                                    <td>{{round($percent_negativas2['mac'],2)}}%</td>
                                    <td>{{round($percent_negativas2['npp'],2)}}%</td>
                                    <td>{{round($percent_negativas2['pt'],2)}}%</td>
                                    <td>{{round($percent_negativas2['mt'],2)}}%</td>

                                    <td>{{round($percent_negativas3['mac'],2)}}%</td>
                                    <td>{{round($percent_negativas3['npp'],2)}}%</td>
                                    <td>{{round($percent_negativas3['pt'],2)}}%</td>
                                    <td>{{round($percent_negativas3['mt'],2)}}%</td>

                                    <td>{{round($percent_negativasf['mfd'],2)}}%</td>
                                    <td>{{round($percent_negativasf['mf'],2)}}%</td>
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

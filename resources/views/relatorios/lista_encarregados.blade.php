@php 
use App\Http\Controllers\ControladorStatic;
$trimestres = [
    '1 Trimestre', '2 Trimestre', '3 Trimestre',
];

$trimestre_totais = [
    'total1'=>0, 'total2'=>0, 'total3'=>0,
];
@endphp
<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Comparticipação de Pais {{$getAno->ano_lectivo}}</title>
<style>
    @page{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
    }
</style>
</head>
<body>
    <div class="header">
        <p>CABECALHO</p>
    </div>

    <div class="body-header">
    <p style="text-align: center;">Lista de Comparticipação de Encarregados referente {{$getAno->ano_lectivo}}</p>
    </div>

    <div class="tabela">
        <table border="1">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Nome do Encarregado</th>
                    <th>Telefone</th>
                    <th>Educandos</th>
                    @foreach ($trimestres as $epoca)
                       <th>{{$epoca}}</th> 
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($getEncarregados as $encarregados)
                <tr>
                    <td>{{$loop->iteration}}</td> 
                    <td>{{$encarregados->pessoa->nome}}</td>
                    <td>{{$encarregados->pessoa->telefone}}</td>
                    <td>
                        <?php 
                        $estudantes = ControladorStatic::getEducandos($encarregados->id);
                        foreach ($estudantes as $estudante) {
                        ?>
                        {{$estudante->pessoa->nome}} <br/>
                        <?php } 
                        ?>
                    </td>

                    @foreach ($trimestres as $epoca)
              
                    <td>
                     <?php 
                       $valores = ControladorStatic::getValoresComparticipacao($epoca, $encarregados->id, $getAno->ano_lectivo);    
                     ?>
                     @if($valores==null)
                     ---
                     @else
                        {{number_format($valores->preco,2,',','.')}} Akz   
                    @endif
                    <?php ?>
                    </td> 
                    @endforeach
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">Total Geral</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
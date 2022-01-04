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
<title>LISTA DE ENCARREGADOS - {{$getAno->ano_lectivo}}</title>
<style>
    @page{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        margin: 10px;
    }

       
        table thead{
            background-color: #4680ff;
            color: #fff;
            font-weight: bold;
        }
</style>
</head>
<body>
    <div class="header">
        @include('include.header_docs')
    </div>

    <div class="body-header">
        <p style="text-align: center; font-weight: bold;">LISTA DE ENCARREGADOS</p>
        <br/>
        ANO LECTIVO: [ {{$getAno->ano_lectivo}} ]<br/>
    </div>

    <div class="tabela">
        <table class="table" border=1 cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
            <thead>
                <tr class="tr_especial">
                    <th>Nº</th>
                    <th>ENCARREGADO</th>
                    <th>TELEFONE</th>
                    <th>ESTUDANTE</th>
                  
                </tr>
            </thead>
            <tbody>
                @foreach ($getEncarregados as $encarregados)
                @if ($encarregados->pessoa->nome=="Encarregado Exemplo")
                    Encarregado nao informado
                @else

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

                </tr>
                @endif
                @endforeach

            </tbody>
        </table>
    </div>
</body>
</html>

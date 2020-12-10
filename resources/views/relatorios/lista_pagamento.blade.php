@php
    use App\Http\Controllers\ControladorStatic;
@endphp
<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>{{$getTipoPagamento->tipo}} {{$getTurma->turma}} {{$getAno}}</title>
<style>
    @page{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
    }
    table, th, td {
    border: 1px solid black;
    }
    
</style>
</head>
<body>
    <div class="header">

    </div>
    <div class="title">
        <p>Curso: {{$getTurma->curso->curso}}</p> 
        <p>Classe: {{$getTurma->classe->classe}}</p> 
        <p>Turma: {{$getTurma->turma}}</p>
        <p>Ano Lectivo: {{$getAno}}</p>

        <p style="font-weight: bold; text-align: center;">Lista de {{$getTipoPagamento->tipo}}</p>
    </div>
    <div class="body">
        @if($getTipoPagamento->id == 3)
        <div class="tabela_comparticipacaoPais">
            <table class="table">
                <thead>
                    <tr>
                        <th>Estudante</th>
                        <th>Nome Encarregado</th>
                        <th>Telefone</th>
                        @foreach ($getEpocasPagamento as $epocas)
                        <th>{{$epocas->epoca}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getHistoricoEstudante as $histoEstudantes)
                        <tr>
                        <td>{{$histoEstudantes->estudante->pessoa->nome}}</td>
                        <td>{{$histoEstudantes->estudante->encarregado->pessoa->nome}}</td>
                        <td>{{$histoEstudantes->estudante->encarregado->pessoa->telefone}}</td>
                        @foreach ($getEpocasPagamento as $epocas)
                        @php
                            $comparticipacao = ControladorStatic::getPagamentosComparticipacao($histoEstudantes->estudante->id_encarregado, $epocas->epoca, $getAno);
                        @endphp
                        <td>
                            @if ($comparticipacao==null)
                                Não Pago
                            @else
                                Pago
                            @endif
                        </td>
                        @endforeach 
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>


        @else
        <div class="tabela_propina">
            <table class="table">
                <thead>
                    <tr>
                        <th>Estudante</th>
                        @foreach ($getEpocasPagamento as $epocas)
                        <th>{{$epocas->epoca}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getHistoricoEstudante as $histoEstudantes)
                        <tr>
                        <td>{{$histoEstudantes->estudante->pessoa->nome}}</td>
                        @foreach ($getEpocasPagamento as $epocas)
                        @php
                            $comparticipacao = ControladorStatic::getPagamentosComparticipacao($histoEstudantes->estudante->id_encarregado, $epocas->epoca, $getAno);
                        @endphp
                        <td>
                            @if ($comparticipacao==null)
                                Não Pago
                            @else
                                Pago
                            @endif
                        </td>
                        @endforeach 
                        </tr>
                    @endforeach
                    
                </tbody>
            </table> 
        </div>
        @endif
    </div>
    
</body>
</html>
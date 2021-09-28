<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>LISTA NOMINAL {{$getAno}} [ {{strtoupper($getTurma->turma)}} - {{strtoupper($getTurma->turno->turno)}} - {{strtoupper($getTurma->curso->curso)}} ] </title>
<style>
    @page{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        margin:10px;
    }
    .mini-cabecalho{
        display: block;
    }
    .ano_curso{
        float: left;
    }
    .periodo{
        float: right;
    }

    table thead{
            background-color: #4680ff;
            color: #fff;
    }

    .tabela{
        font-size: 10px;
    }

    .transferido{
        background-color:#FFB64D;
        color:#fff;
        font-weight: bold;
    }
    .desistencia{
        background-color:#FC6180;
        color:#fff;
        font-weight: bold;
    }
</style>
</head>
<body>
    <div class="cabecalho">
        @include('include.header_docs')
    </div>
    <div class="titulo">
        <p style="text-align: center; font-weight:bold;">LISTA NOMINAL</p>
     </div>
     <div class="mini-cabecalho">
        <div class="ano_curso">
            {{$getAno}} - [ {{strtoupper($getTurma->turma)}} - {{strtoupper($getTurma->curso->curso)}} ]
        </div>
        <div class="periodo">
            PERÍODO: {{strtoupper($getTurma->turno->turno)}}<br/>
        </div>
     </div>
    <br/>
     <div class="corpo">
         <div class="table-resposive">
             <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>NOME COMPLETO</th>
                        <th>GÊNERO</th>
                        <th>IDADE</th>
                        <th>OBS.</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($getHistorico as $historico)
                <tr class="{{$historico->observacao_final}}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$historico->estudante->pessoa->nome}}</td>
                    <td>{{$historico->estudante->pessoa->genero}}</td>
                    <td>
                        <?php
                        $data_string = explode('-', $historico->estudante->pessoa->data_nascimento);
                        $idade = date('Y') - $data_string[0];
                        ?>
                        @if ($idade==0)
                        ---
                        @else
                        {{$idade}}
                        @endif

                    </td>
                    <td>
                        @if ($historico->observacao_final == "transferido")
                            Transferência
                        @elseif($historico->observacao_final == "desistencia")
                            Desistência
                        @endif
                    </td>
                    </tr>
                    @endforeach
                </tbody>
             </table>
         </div>
     </div>
</body>
</html>

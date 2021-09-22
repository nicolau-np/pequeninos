<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Lista Nominal {{$getTurma->turma}} {{$getAno}}</title>
<style>
    @page{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
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
            {{$getAno}}
        </div>
        <div class="periodo">
            Turno: {{$getTurma->turno->turno}}<br/>
        </div>
     </div>
    <br/><br/>
     <div class="corpo">
         <div class="table-resposive">
             <table border="1">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>NOME COMPLETO</th>
                        <th>Gênero</th>
                        <th>Idade</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($getHistorico as $historico)
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$historico->estudante->pessoa->nome}}</td>
                    <td>{{$historico->estudante->pessoa->genero}}</td>
                    <td>
                        <?php
                        $data_string = explode('-', $historico->estudante->pessoa->data_nascimento);
                        $idade = date('Y') - $data_string[0];
                        ?>
                        {{$idade}}
                    </td>
                    </tr>
                    @endforeach
                </tbody>
             </table>
         </div>
     </div>
</body>
</html>

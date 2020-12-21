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
</style>
</head>
<body>
    <div class="cabecalho">

    </div>
    <div class="mini-cabecalho">
        <p style="text-align: center; font-weight:bold;">Lista Nominal</p>
        <p>
            Curso: {{$getTurma->curso->curso}}<br/>
            Turma: {{$getTurma->turma}}<br/>
            Classe: {{$getTurma->classe->classe}}<br/>
            Ano Lectivo: {{$getAno}}<br/>
        </p>
     </div>

     <div class="corpo">
         <div class="table-resposive">
             <table border="1">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Estudante</th>
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
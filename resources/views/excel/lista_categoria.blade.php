<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

<h1>{{$categoria}}</h1>
    <div class="corpo">

        <div class="table-resposive">
            <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Nº PROC.</th>
                        <th>NOME COMPLETO</th>
                        <th>GÊNERO</th>
                        <th>IDADE</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($getEstudantes as $estudante)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $estudante->id }}</td>
                            <td>{{ $estudante->pessoa->nome }}</td>
                            <td>{{ $estudante->pessoa->genero }}</td>
                            <td>
                                <?php
                                $data_string = explode('-', $estudante->pessoa->data_nascimento);
                                $idade = date('Y') - $data_string[0];
                                ?>
                                @if ($idade == 0)
                                    ---
                                @else
                                    {{ $idade }}
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

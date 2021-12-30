<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>


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
                        <th>CATEGORIA</th>
                        <th>OBS.</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($getHistorico as $historico)
                        <tr class="{{ $historico->observacao_final }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $historico->id_estudante }}</td>
                            <td>{{ $historico->estudante->pessoa->nome }}</td>
                            <td>{{ $historico->estudante->pessoa->genero }}</td>
                            <td>
                                <?php
                                $data_string = explode('-', $historico->estudante->pessoa->data_nascimento);
                                $idade = date('Y') - $data_string[0];
                                ?>
                                @if ($idade == 0)
                                    ---
                                @else
                                    {{ $idade }}
                                @endif

                            </td>
                            <td>{{ $historico->categoria }}</td>
                            <td>
                                @if ($historico->observacao_final == 'transferido')
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

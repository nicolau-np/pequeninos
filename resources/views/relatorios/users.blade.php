<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LISTA DE USUARIOS</title>
    <style>
        @page{
            font-family: Arial, Helvetica, sans-serif;
            font-size:16px;
        }
        tbody tr td{
            padding: 10px;
        }
    </style>
</head>

<body>
    <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
        @foreach ($getUsuarios as $users)
        <tbody>
            

                <tr>
                    <td><b>ID:</b> {{ $users->id }}</td>
                    <td><b>Nome Completo:</b>{{ $users->pessoa->nome }}</td>
                    <td><b>Username:</b> {{ $users->username }}</td>
                    <td><b>Password:</b> escola001</td>
                </tr>
            
        </tbody>
        @endforeach
    </table>
</body>

</html>

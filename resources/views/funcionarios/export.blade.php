<div>
    <table>
        <tr>
            <td>nome</td>
            <td>genero</td>
            <td>data_nascimento</td>
        </tr>

        @foreach ($getFuncionarios as $funcionarios)
        <tr>
            <td>{{$funcionarios->pessoa->nome}}</td>
            <td>{{$funcionarios->pessoa->genero}}</td>
            <td>{{date('d-m-Y', strtotime($funcionarios->pessoa->data_nascimento))}}</td>
        </tr>
        @endforeach
    </table>
</div>

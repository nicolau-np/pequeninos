@foreach ($getEncarregados as $encarregados)
                                    
<tr>
<th scope="row">{{$loop->iteration}}</th>
    <td>{{$encarregados->pessoa->nome}}</td>
    <td>{{$encarregados->pessoa->municipio->provincia->provincia}}</td>
    <td>{{$encarregados->pessoa->municipio->municipio}}</td>
    <td>{{$encarregados->pessoa->telefone}}</td>
    <td>
        <a href="/encarregados/edit/{{$encarregados->id}}" class="btn btn-primary btn-sm"><i class="ti-pencil-alt"></i> Editar</a>
        <a href="http://" class="btn btn-danger btn-sm"><i class="ti-trash"></i> Eliminar</a>
    </td>
</tr>

@endforeach
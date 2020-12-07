@foreach ($getFuncionarios as $funcionarios)
                                    
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$funcionarios->pessoa->nome}}</td>
                                    <td>{{$funcionarios->pessoa->genero}}</td>
                                    <td>{{$funcionarios->cargo->cargo}}</td>
                                    <td>{{$funcionarios->escalao->escalao}}</td>
                                    <td>
                                        <a href="/funcionarios/horario/{{$funcionarios->id}}" class="btn btn-success btn-sm"><i class="ti-time"></i> Hora.</a>
                                        <a href="/funcionarios/edit/{{$funcionarios->id}}" class="btn btn-primary btn-sm"><i class="ti-pencil-alt"></i> Editar</a>
                                        <a href="http://" class="btn btn-danger btn-sm"><i class="ti-trash"></i> Eliminar</a>
                                    </td>
                                </tr>

                                @endforeach
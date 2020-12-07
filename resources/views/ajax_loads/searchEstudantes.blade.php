@foreach ($getEstudantes as $estudantes)
                                    
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$estudantes->pessoa->nome}}</td>
                                    <td>{{$estudantes->turma->curso->curso}}</td>
                                    <td>{{$estudantes->turma->classe->classe}}</td>
                                    <td>{{$estudantes->turma->turno->turno}}</td>
                                    <td>{{$estudantes->turma->turma}}</td>
                                    <td>{{$estudantes->ano_lectivo}}</td>
                                    <td>
                                        <a href="/pagamentos/create/{{$estudantes->id}}" class="btn btn-success btn-sm"><i class="ti-money"></i> Pag.</a>
                                        <a href="/estudantes/edit/{{$estudantes->id}}" class="btn btn-primary btn-sm"><i class="ti-pencil-alt"></i> Editar</a>
                                        <a href="http://" class="btn btn-danger btn-sm"><i class="ti-trash"></i> Eliminar</a>
                                    </td>
                                </tr>

                                @endforeach

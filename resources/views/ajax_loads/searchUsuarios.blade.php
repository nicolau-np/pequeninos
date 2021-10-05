@if($getUsuarios->count()==0)
                                <span class="not_found">Nenhum usuário cadastrado</span>
                                @else
                                @foreach ($getUsuarios as $usuarios)

                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$usuarios->pessoa->nome}}</td>
                                    <td>{{$usuarios->username}}</td>
                                    <td>{{$usuarios->email}}</td>
                                    <td>{{$usuarios->estado}}</td>
                                    <td>{{$usuarios->nivel_acesso}}</td>

                                </tr>

                                @endforeach
                                @endif

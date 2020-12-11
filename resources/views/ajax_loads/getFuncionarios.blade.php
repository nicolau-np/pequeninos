@foreach ($getFuncionarios as $funcionarios)
<input type="radio" name="funcionario" id="funcionario" value="{{$funcionarios->id}}"/> {{$funcionarios->pessoa->nome}} {{$funcionarios->pessoa->telefone}}<br/>
@endforeach
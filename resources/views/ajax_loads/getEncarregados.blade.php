@foreach ($getEncarregados as $encarregados)
<input type="radio" name="encarregado" id="encarregado" value="{{$encarregados->id}}"/> {{$encarregados->pessoa->nome}} {{$encarregados->pessoa->telefone}}<br/>
@endforeach

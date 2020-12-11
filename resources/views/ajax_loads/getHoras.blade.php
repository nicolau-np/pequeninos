<select name="hora" class="form-control">
    <option value="">Hora</option>
    @foreach ($getHoras as $hora)
    <option value="{{$hora->id}}">{{$hora->hora_entrada}} - {{$hora->hora_saida}}</option>
    @endforeach
</select>
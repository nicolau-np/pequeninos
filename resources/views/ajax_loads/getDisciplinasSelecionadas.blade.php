@foreach (session()->get('disciplinas') as $disciplinas)
    {{$disciplinas['sigla']}} <br/>
@endforeach
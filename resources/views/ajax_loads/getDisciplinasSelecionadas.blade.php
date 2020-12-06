@foreach (session()->get('disciplinas') as $disc)
    {{$disc["sigla"]}} - <br/>
@endforeach
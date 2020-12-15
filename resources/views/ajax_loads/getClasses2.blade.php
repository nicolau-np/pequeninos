<br/>
@foreach ($getClasses as $classes)
<input type="checkbox" name="classe[]" value="{{$classes->id}}"> {{$classes->classe}}<br/> 
@endforeach

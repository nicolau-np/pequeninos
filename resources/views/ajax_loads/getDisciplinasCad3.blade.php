<div class="col-md-3">
    {{Form::label('disciplina1', "Disciplina 1")}} <span class="text-danger">*</span>
    {{ Form::select('disciplina1', $getGrade, null, ['class'=>"form-control", 'placeholder'=>"Disciplina 1"]) }}
<div class="erro">
    @if($errors->has('disciplina1'))
    <div class="text-danger">{{$errors->first('disciplina1')}}</div>
    @endif
</div>
</div>

<div class="col-md-3">
    {{Form::label('disciplina2', "Disciplina 2")}} <span class="text-danger">*</span>
    {{ Form::select('disciplina2', $getGrade, null, ['class'=>"form-control", 'placeholder'=>"Disciplina 2"]) }}
<div class="erro">
    @if($errors->has('disciplina2'))
    <div class="text-danger">{{$errors->first('disciplina2')}}</div>
    @endif
</div>
</div>

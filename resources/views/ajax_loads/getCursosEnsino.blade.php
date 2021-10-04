{{Form::select('id_curso', $getCursos, null, ['class'=>"form-control changeCurso", 'placeholder'=>"Curso"])}}

<script>
$('document').ready(function(){
    $('.changeCurso').change(function(e){
        if($(this).val()!==""){
        var data = {
            id_curso: $(this).val(),
            _token: "{{csrf_token()}}"
        };
        $.ajax({
                type: "post",
                url: "{{route('getDisciplinasCurso')}}",
                data: data,
                dataType: "html",

                success: function (response) {
                    $('.loadDisciplinas').html(response);
                }
            });
        }
    });

});
</script>

{{Form::select('turma', $getTurmas, null, ['class'=>"form-control turma", 'placeholder'=>"Turma"])}}

<script>
    $(document).ready(function(){
     $('.turma').change(function (e) { 
         e.preventDefault();
         var data = {
            id_turma: $(this).val(),
            _token: "{{ csrf_token() }}"
         };

        $.ajax({
             type: "post",
             url: "{{route('getHoras')}}",
             data: data,
             dataType: "html",
             success: function (response) {
                 $('.load_horas').html(response);
             }
         });

     });
    });
</script>
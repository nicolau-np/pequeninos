{{Form::select('classe', $getClasses, null, ['class'=>"form-control classe", 'placeholder'=>"Classe"])}}


<script>
    $(document).ready(function(){
        $('.classe').change(function(e) {
            e.preventDefault();
            var data = {
                id_curso: $('.curso').val(),
                id_classe: $(this).val(),
                _token: "{{ csrf_token() }}"
            };
            if((data.id_classe!="") && (data.id_curso!="")){
                getDisciplinas(data);
            }

        });

        function getDisciplinas(data){
            $.ajax({
                type: "post",
                url: "{{route('getDisciplinasCad3')}}",
                data: data,
                dataType: "html",
                success: function (response) {
                    $('.load_disciplinas').html(response);
                }
            });
        }
    });
</script>



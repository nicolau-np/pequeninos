<!--{{ Form::select('turma', $getTurmas, null, ['class' => 'form-control turma', 'placeholder' => 'Turma']) }}-->
<select name="turma" class="form-control turma">
    <option hidden value="">Turma</option>
    @foreach ($getTurmas as $turmas)
        <option value="{{ $turmas->id }}">{{ $turmas->turma }} ({{ $turmas->ano_lectivo }})</option>
    @endforeach
</select>

<script>
    $(document).ready(function() {
        $('.turma').change(function(e) {
            e.preventDefault();
            var data = {
                id_turma: $(this).val(),
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                type: "post",
                url: "{{ route('getHoras') }}",
                data: data,
                dataType: "html",
                success: function(response) {
                    $('.load_horas').html(response);
                }
            });

        });
    });
</script>

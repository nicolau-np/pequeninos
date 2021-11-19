@php
use App\Http\Controllers\ControladorStatic;
@endphp
<div class="list">
<h4>Pagamentos Efectuados em: {{date('d-m-Y', strtotime($getData))}}</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Estudante</th>
                <th>Turma</th>
                <th>Pagamentos Efectuados</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($getPagamentosEfectuados as $pags_efectuados)

                <tr>
                <td style="font-weight: bold;">{{$pags_efectuados->pessoa->nome}}</td>
                <td>{{$pags_efectuados->turma->turma}}</td>
                <td>
                    @php
                        $pagamentos = ControladorStatic::getPagamentosEfectuados($pags_efectuados->id, $getData);

                    @endphp

                    @foreach ($pagamentos as $pags)
                       <a href="#"> {{$pags->epoca}}</a><br/>
                    @endforeach
                </td>

                </tr>
            @endforeach

        </tbody>
    </table>

</div>

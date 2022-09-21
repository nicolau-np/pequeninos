<div>
    <table>
        <tr>
            <!-- pessoa -->
            <td>nome</td>
            <td>genero</td>
            <td>municipio</td>
            <td>data_nascimento</td>
            <td>naturalidade</td>
            <td>telefone</td>,
            <td>bilhete</td>,
            <td>data_emissao</td>,
            <td>local_emissao</td>,
            <td>pai</td>,
            <td>mae</td>,
            <td>comuna</td>,
            <td>residencia</td>
            <td>rua</td>
            <td>bairro</td>
            <td>deficiencia</td>
            <td>tipo_deficiencia</td>
            <!-- end-->

            <!-- estudante -->
            <td>id_turma</td>
            <td>id_pessoa</td>
            <td>id_encarregado</td>
            <td>numero</td>
            <td>numero_acesso</td>
            <td>categoria</td>
            <td>estado_estudante</td>
            <td>ano_lectivo</td>
            <!-- end-->

            <!-- historico estudante-->
            <td>id_estudante</td>
            <td>id_turma</td>
            <td>numero</td>
            <td>numero_acesso</td>
            <td>categoria</td>
            <td>estado_historico</td>
            <td>observacao_final</td>
            <td>obs_pauta</td>
            <td>ano_lectivo</td>
            <!-- end-->
            </td>

            @foreach ($getEstudantes as $estudantes)
        <tr>
            <td>{{ $estudantes->pessoa->nome }}</td>
            <td>{{ $estudantes->pessoa->genero }}</td>
            <td>{{ $estudantes->pessoa->id_municipio }}</td>
            <td>{{ date('Y-m-d', strtotime($estudantes->pessoa->data_nascimento)) }}</td>
            <td>{{ $estudantes->pessoa->naturalidade }}</td>
            <td>{{ $estudantes->pessoa->telefone }}</td>,
            <td>{{ $estudantes->pessoa->bilhete }}</td>,
            <td>{{ $estudantes->pessoa->data_emissao }}</td>,
            <td>{{ $estudantes->pessoa->local_emissao }}</td>,
            <td>{{ $estudantes->pessoa->pai }}</td>,
            <td>{{ $estudantes->pessoa->mae }}</td>,
            <td>{{ $estudantes->pessoa->comuna }}</td>,
            <td>{{ $estudantes->pessoa->residencia }}</td>
            <td>{{ $estudantes->pessoa->rua }}</td>
            <td>{{ $estudantes->pessoa->bairro }}</td>
            <td>{{ $estudantes->pessoa->deficiencia }}</td>
            <td>{{ $estudantes->pessoa->tipo_deficiencia }}</td>

            <td>{{ $estudantes->id_turma }}</td>
            <td>{{ $estudantes->id_pessoa }}</td>
            <td>{{ $estudantes->id_encarregado }}</td>
            <td>{{ $estudantes->numero }}</td>
            <td>{{ $estudantes->numero_acesso }}</td>
            <td>{{ $estudantes->categoria }}</td>
            <td>{{ $estudantes->estado }}</td>
            <td>{{ $estudantes->ano_lectivo }}</td>

            <td>{{ $estudantes->id }}</td>
            <td>{{ $estudantes->historico->id_turma }}</td>
            <td>{{ $estudantes->historico->numero }}</td>
            <td>{{ $estudantes->historico->numero_acesso }}</td>
            <td>{{ $estudantes->historico->categoria }}</td>
            <td>{{ $estudantes->historico->estado }}</td>
            <td>{{ $estudantes->historico->observacao_final }}</td>
            <td>{{ $estudantes->historico->obs_pauta }}</td>
            <td>{{ $estudantes->historico->ano_lectivo }}</td>
        </tr>
        @endforeach
    </table>
</div>

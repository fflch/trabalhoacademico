@can('docente')
    <div class="card">
        <div class="card-header"><b>Defesas Agendadas para Liberação</b></div>
        <table class="table table-striped">
            <theader>
                <tr>
                    <th>Nº USP</th>
                    <th>Nome</th>
                    <th>Data da Defesa</th>
                    <th>Orientador</th>
                    <th>Status</th>
                </tr>
            </theader>
            <tbody>
            @foreach ($agendamentos->where('status', 'Em Elaboração')->whereNotNull('data_enviado_avaliacao') as $agendamento)
                <tr>
                    <td>{{ $agendamento->user->codpes }}</td>
                    <td><a href="/agendamentos/{{$agendamento->id}}">{{ $agendamento->user->name }}</a></td>
                    <td>{{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') }}</td>
                    <td>{{ $agendamento->nome_do_orientador}}</td>
                    <td>{{ $agendamento->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div class="card">
        <div class="card-header"><b>Defesas Agendadas para Avaliação</b></div>
        <table class="table table-striped">
            <theader>
                <tr>
                    <th>Nº USP</th>
                    <th>Nome</th>
                    <th>Data da Defesa</th>
                    <th>Orientador</th>
                    <th>Status</th>
                </tr>
            </theader>
            <tbody>
            @foreach ($agendamentos->where('status', 'Em Avaliação') as $agendamento)
                <tr>
                    <td>{{ $agendamento->user->codpes }}</td>
                    <td><a href="/agendamentos/{{$agendamento->id}}">{{ $agendamento->user->name }}</a></td>
                    <td>{{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') }}</td>
                    <td>{{ $agendamento->nome_do_orientador}}</td>
                    <td>{{ $agendamento->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@elsecan('biblioteca')
    <br>
    <div class="card">
        <div class="card-header"><h3>Trabalhos Acadêmicos Aprovados</h3></div>
        <table class="table table-striped">
            <theader>
                <tr>
                    <th>Nº USP</th>
                    <th>Nome</th>
                    <th>Data da Defesa</th>
                    <th>Orientador</th>
                    <th>Status Publicação</th>
                    <th>Ações</th>
                </tr>
            </theader>
            <tbody>
            @foreach ($agendamentos->where('publicado', 'Não') as $agendamento)
                <tr>
                    <td>{{ $agendamento->user->codpes }}</td>
                    <td>{{ $agendamento->user->name }}</a></td>
                    <td>{{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') }}</td>
                    <td>{{ $agendamento->nome_do_orientador}}</td>
                    <td>{{ $agendamento->publicado}}</td>
                    <td><a href="/agendamentos/{{$agendamento->id}}" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Publicar</i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div class="card">
        <div class="card-header"><h3>Trabalhos Acadêmicos Publicados</h3></div>
        <table class="table table-striped">
            <theader>
                <tr>
                    <th>Nº USP</th>
                    <th>Nome</th>
                    <th>Data da Defesa</th>
                    <th>Orientador</th>
                    <th>Status Publicação</th>
                    <th>Ações</th>
                </tr>
            </theader>
            <tbody>
            @foreach ($agendamentos->where('publicado', 'Sim') as $agendamento)
                <tr>
                    <td>{{ $agendamento->user->codpes }}</td>
                    <td>{{ $agendamento->user->name }}</a></td>
                    <td>{{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') }}</td>
                    <td>{{ $agendamento->nome_do_orientador}}</td>
                    <td>{{ $agendamento->publicado}}</td>
                    <td><a href="/agendamentos/{{$agendamento->id}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="card">
        <div class="card-header"><h3>Minhas defesas</h3></div>
        <table class="table table-striped">
            <theader>
                <tr>
                    <th>Nº USP</th>
                    <th>Nome</th>
                    <th>Data da Defesa</th>
                    <th>Orientador</th>
                    <th>Status</th>
                </tr>
            </theader>
            <tbody>
            @foreach ($agendamentos as $agendamento)
                @can('owner', $agendamento)
                    <tr>
                        <td>{{ $agendamento->user->codpes }}</td>
                        <td><a href="/agendamentos/{{$agendamento->id}}">{{ $agendamento->user->name }}</a></td>
                        <td>{{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') }}</td>
                        <td>{{ $agendamento->nome_do_orientador}}</td>
                        <td>{{ $agendamento->status}}</td>
                    </tr>
                @endcan
            @endforeach
            </tbody>
        </table>
    </div>
@endcan
{{ $agendamentos->appends(request()->query())->links() }}
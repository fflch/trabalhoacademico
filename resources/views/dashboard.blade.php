@extends('laravel-usp-theme::master')

@section('content')
@inject('pessoa','Uspdev\Replicado\Pessoa')
@include('flash')

@can('DOCENTE')
    <div class="card">
        <div class="card-header"><h3>Defesas Agendadas para Liberação</h3></div>
        <div class="card-body">
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
    </div>
    <br>
    <div class="card">
        <div class="card-header"><h3>Defesas Agendadas para Avaliação</h3></div>
        <div class="card-body">
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
    </div>
@endcan
@can('ALUNO')
    <div class="card">
        <div class="card-header"><h3>Minhas defesas</h3></div>
        <div class="card-body">
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
                    @can('OWNER', $agendamento)
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
    </div>
@endcan
@can('BIBLIOTECA')
    <br>
    <div class="card">
        <div class="card-header"><h3>Trabalhos Acadêmicos Aprovados</h3></div>
        <div class="card-body">
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
                @foreach ($agendamentos as $agendamento)
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
    </div>
@endcan
{{ $agendamentos->appends(request()->query())->links() }}
@endsection('content')
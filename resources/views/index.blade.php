@extends('laravel-usp-theme::master')

@section('content')
@inject('pessoa','Uspdev\Replicado\Pessoa')
@include('flash')

<div class="card">
    <div class="card-header">@if($pessoa::cracha(Auth::user()->codpes)['tipvinaux'] == 'SERVIDOR') Minhas defesas agendadas @elseif($pessoa::cracha(Auth::user()->codpes)['tipvinaux'] == 'DOCENTE') Defesas Agendadas para Avaliação @endif</div>
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

@endsection('content')
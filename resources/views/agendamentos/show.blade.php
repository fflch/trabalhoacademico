@extends('laravel-usp-theme::master')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('/css/agendamentos.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/stepper.css')}}">
@endsection('styles')

@section('content')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    @include('flash')
    @can('LOGADO')
        @include('agendamentos.partials.cabecalho')
    @endcan
    @can('BIBLIOTECA')
        <br>
        @include('agendamentos.partials.biblioteca')
    @endcan
    <br>
    @include('agendamentos.partials.dados_pessoais')
    <br>
    @include('agendamentos.partials.dados_trabalho')
    <br>
    @include('agendamentos.partials.banca')
    <br>
    @can('OWNER', $agendamento)
        @include('agendamentos.partials.documentos')
    @elsecan('DOCENTE', $agendamento)
        @include('agendamentos.partials.documentos')
    @endcan
    <br>
    @include('agendamentos.partials.files')
    @can('ADMIN')
        @if($agendamento->status != 'Em Elaboração' and $agendamento->status != 'Em Avaliação')
        <br>
        <div class="col-auto">
            <form method="POST" action="/agendamentos/voltar_defesa/{{ $agendamento->id }}">
                @csrf 
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja voltar defesa para status Em Avaliação?')"> Voltar para status 'Em Avaliação' </button>
            </form>
        </div>
        @endif
    @endcan
@endsection('content')

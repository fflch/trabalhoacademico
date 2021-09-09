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
        @include('agendamentos.partials.etapas')
        @include('agendamentos.partials.comentarios')
    @endcan
    @can('BIBLIOTECA')
        @include('agendamentos.partials.biblioteca')
    @endcan
    @include('agendamentos.partials.dados_pessoais')
    @include('agendamentos.partials.dados_trabalho')
    @include('agendamentos.partials.banca')
    @can('OWNER', $agendamento)
        @include('agendamentos.partials.documentos')
    @elsecan('DOCENTE', $agendamento)
        @include('agendamentos.partials.documentos')
    @endcan
    @include('agendamentos.partials.files')

    @can('ADMIN')
        @if($agendamento->data_enviado_avaliacao != null)
            <div class="col-auto">
                <form method="POST" action="/agendamentos/voltar_defesa/{{ $agendamento->id }}">
                    @csrf 
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja voltar status?')"> Voltar para status anterior </button>
                </form>
            </div>
        @endif
    @endcan
@endsection('content')

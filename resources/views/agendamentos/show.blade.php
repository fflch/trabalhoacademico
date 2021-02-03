@extends('laravel-usp-theme::master')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('/css/agendamentos.css')}}">
@endsection('styles')

@section('content')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    @include('flash')
    @can('LOGADO')
        @include('agendamentos.partials.cabecalho')
    @endcan
    <br>
    @include('agendamentos.partials.dados_pessoais')
    <br>
    @include('agendamentos.partials.dados_trabalho')
    <br>
    @include('agendamentos.partials.banca')
    <br>
    @include('agendamentos.partials.documentos')
    <br>
    @include('agendamentos.partials.files')
@endsection('content')

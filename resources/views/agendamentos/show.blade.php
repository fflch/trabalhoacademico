@extends('laravel-usp-theme::master')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('/css/agendamentos.css')}}">
@endsection('styles')

@section('content')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    @include('flash')
    @include('agendamentos.partials.cabecalho')
    <br>
    @include('agendamentos.partials.dados_pessoais')
    <br>
    @include('agendamentos.partials.dados_trabalho')
    <br>
    @include('agendamentos.partials.banca')
    <br>
    @include('agendamentos.partials.files')

    <form method="POST" action="/agendamentos/enviar_avaliacao/{{ $agendamento->id }}">
        @csrf 
        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja enviar para Avaliação?')"> Enviar para Avaliação do(a) orientador(a) </button>
     </form>

@endsection('content')

@extends('laravel-usp-theme::master')

@section('content')
    @include('flash')

    <div class="card">
        <div class="card-header">Registrar Professor na Banca de Defesa</div>
        <div class="card-body">
            <form action="/agendamentos/{{$agendamento}}/bancas" method="POST">
                @csrf
                @include('agendamentos.bancas.form')
            </form>
        </div>
    </div>
@endsection('content')
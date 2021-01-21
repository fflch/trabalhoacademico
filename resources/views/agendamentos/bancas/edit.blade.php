@extends('laravel-usp-theme::master')

@section('content')
    @include('flash')

    <div class="card">
        <div class="card-header"><h4>Editar - Banca</h4></div>
        <div class="card-body">
            <form action="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('agendamentos.bancas.form')
            </form>
        </div>
    </div>
@endsection('content')
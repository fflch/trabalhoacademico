@extends('laravel-usp-theme::master')

@section('content')
    <form action="/agendamentos" method="POST">
        @csrf
        @method('PATCH')
        @include('agendamentos.form')
    </form>
@endsection('content')

@extends('laravel-usp-theme::master')

@section('content')
    <form action="/agendamentos" method="POST">
        @csrf
        @include('agendamentos.form')
    </form>
@endsection('content')

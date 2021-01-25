@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascripts_bottom')

@section('content')
@include('flash')
    <form action="/agendamentos/{{$agendamento->id}}" method="POST">
        @csrf
        @method('PATCH')
        @include('agendamentos.form')
    </form>
@endsection('content')

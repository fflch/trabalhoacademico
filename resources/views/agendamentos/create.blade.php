@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascripts_bottom')

@section('content')
@include('flash')
    <form action="/agendamentos" method="POST">
        @csrf
        @include('agendamentos.form')
    </form>
@endsection('content')

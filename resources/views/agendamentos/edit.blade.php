@extends('laravel-usp-theme::master')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{{asset('/css/agendamentos.css')}}">
@endsection('styles')

@section('content')
@include('flash')
  <form action="/agendamentos/{{$agendamento->id}}" method="POST">
    @csrf
    @method('PATCH')
    @include('agendamentos.partials.form')
  </form>
@endsection('content')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascripts_bottom')
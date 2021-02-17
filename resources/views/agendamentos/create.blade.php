@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascripts_bottom')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('/css/agendamentos.css')}}">
@endsection('styles')

@section('content')
@inject('graduacao','Uspdev\Replicado\Graduacao')
@include('flash')
    <form action="/agendamentos" method="POST">
        @csrf
        @include('agendamentos.partials.form')
    </form>
@endsection('content')

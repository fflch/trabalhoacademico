@extends('laravel-usp-theme::master')

@section('javascripts_head')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @include('flash')
    @if(Auth::guest())
        @include('partials.agendamentos')
    @elseif(Auth::check())
        @include('partials.dashboard')
    @endif
@endsection('content')
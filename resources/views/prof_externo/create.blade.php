@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @include('flash')

    <div class="card">
        <div class="card-header">Cadastrar Docente</div>
        <div class="card-body">
            <form action="/prof_externo" method="POST">
                @csrf
                @include('prof_externo.form')
            </form>
        </div>
    </div>
@endsection('content')
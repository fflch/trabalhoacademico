@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @include('flash')
    <div class="card">
        <div class="card-header"><b>Editar - Usuário</b></div>
        <div class="card-body">
            <form action="/users/{{$user->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('users.form')
            </form>
        </div>
    </div>
@endsection('content')
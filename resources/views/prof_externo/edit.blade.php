@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @include('flash')

    <div class="row" style="margin-bottom:0.5em;">
        <div class="col-sm">
            <a href="/prof_externo/create" class="btn btn-primary">Cadastrar Docente</a></br>
        </div>
        <div class="col-auto float-right">
            <form method="POST" action="/prof_externo/{{ $profExterno->id }}">
                @csrf 
                @method('delete')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><b>Editar - Docente</b></div>
        <div class="card-body">
            <form action="/prof_externo/{{$profExterno->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('prof_externo.form')
            </form>
        </div>
    </div>
@endsection('content')
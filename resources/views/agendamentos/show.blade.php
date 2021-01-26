@extends('laravel-usp-theme::master')

@section('content')
@inject('pessoa','Uspdev\Replicado\Pessoa')
@include('flash')
    <div class="row">
        <div class="col-sm">
            <a href="/agendamentos/create" class="btn btn-success">Agendar Novo Trabalho Acadêmico</a></br>
        </div>
        <div class="col-sm ">
            <div class="row float-right">
                <div class="col-auto">
                    <a href="/agendamentos/{{$agendamento->id}}/edit" class="btn btn-warning">Editar Trabalho Acadêmico</a>
                </div>
                <div class="col-auto">
                    <form method="POST" action="/agendamentos/{{ $agendamento->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    @include('agendamentos.partials.dados_pessoais')
    <br>
    @include('agendamentos.partials.dados_trabalho')
    <br>
    @include('agendamentos.partials.banca')
    <br>
    @include('agendamentos.partials.files')
@endsection('content')

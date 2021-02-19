@extends('laravel-usp-theme::master')

@section('content')
@inject('pessoa','Uspdev\Replicado\Pessoa')

    <div class="row">
        <div class="col-sm">
            <a href="/prof_externo/create" class="btn btn-success">Cadastrar Docente</a></br>
        </div>
        <div class="col-sm ">
            <div class="row float-right">
                <div class="col-auto">
                    <a href="/prof_externo/{{$profExterno->id}}/edit" class="btn btn-warning">Editar Docente</a>
                </div>
                <div class="col-auto">
                    <form method="POST" action="/prof_externo/{{ $profExterno->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header"><b>Docente</b></div>
        <div class="card-body">
            <b>Nome Completo:</b> {{$profExterno->nome}}</br>
            <b>CPF:</b> {{ $profExterno->cpf }}</br>
            <b>RG:</b> {{$profExterno->rg}}</br>
            <b>Endereço:</b> {{$profExterno->endereco}}</br>
            <b>Bairro:</b> {{$profExterno->bairro}}</br>
            <b>CEP:</b> {{$profExterno->cep}}</br>
            <b>Cidade:</b> {{$profExterno->cidade}}</br>
            <b>Estado:</b> {{$profExterno->estado}}</br>
            <b>País:</b> {{$profExterno->pais}}</br>
            <b>Telefones:</b> {{$profExterno->telefone}}</br>
            <b>Nome e sigla da Universidade na qual tem vínculo profissional:</b> {{$profExterno->instituicao}}</br>
            <b>E-mail:</b> {{$profExterno->email}}</br>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header"><b>Bancas de defesa que participou como Examinador(a)</b></div>
        <table class="table table-striped" style="text-align:center;">
            <thead class="thead-light">
                <tr>
                    <th>Candidato</th>
                    <th>Título</th>
                    <th>Data</th>
                    <th>Curso</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profExterno->getBancasProfessor($profExterno->id,'Examinador') as $bancas)
                    @foreach($bancas as $banca)
                    <tr>
                        <td><a href="/agendamentos/{{$banca->user->id}}">{{$banca->user->name}}</a></td>
                        <td>{{$banca->titulo}}</td>
                        <td>{{Carbon\Carbon::parse($banca->data_da_defesa)->format('d/m/Y')}}</td>
                        <td>{{$banca->curso}}</td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

    </div>
@endsection('content')

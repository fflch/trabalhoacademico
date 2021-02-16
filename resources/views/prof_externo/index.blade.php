@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    @include('flash')

    <a href="/prof_externo/create" class="btn btn-primary">Cadastrar Docente</a>
    </br></br>
    <div class="card">
        <div class="card-body">
            <form method="GET" action="/prof_externo">
                <div class="row form-group">
                    <div class="col-auto">
                        <label style="margin-top:0.35em; margin-bottom:0em;"><h5><b>Buscar: </b></h5></label>
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col-sm form-group" id="busca">
                        <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}" placeholder="Digite o nome completo ou parte dele para buscar">
                    </div>
                    <div class=" col-auto form-group">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped" style="text-align:center">
        <theader>
            <tr>
                <th>Nome</th>
                <th colspan="2">Ações</th>
                <th>Última alteração</th>
            </tr>
        </theader>
        <tbody>
        @foreach ($profExternos as $profExterno)
            <tr>
                <td><a href="/prof_externo/{{$profExterno->id}}">{{ $profExterno->nome }}</a></td>
                <td>
                    <a href="/prof_externo/{{$profExterno->id}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                </td>
                <td>
                    <form method="POST" action="/prof_externo/{{ $profExterno->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
                <td>
                    por: {{$pessoa::dump($profExterno->last_user)['nompes']}} em: {{Carbon\Carbon::parse($profExterno->updated_at)->format('d/m/Y')}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $profExternos->appends(request()->query())->links() }}
@endsection('content')

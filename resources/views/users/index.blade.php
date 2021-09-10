@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    @include('flash')
    <div class="card">
        <div class="card-body">
            <form method="GET" action="/users">
                <div class="row form-group">
                    <div class="col-sm" id="busca">
                        <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}" placeholder="Digite o número USP, nome ou email para buscar">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped" style="text-align:center">
        <theader>
            <tr>
                <th>Número USP</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </theader>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->codpes }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="/users/{{$user->id}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->appends(request()->query())->links() }}
@endsection('content')

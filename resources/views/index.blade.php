@extends('laravel-usp-theme::master')

@section('javascripts_head')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @include('flash')
    @inject('graduacao','Uspdev\Replicado\Graduacao')
    <br>
    <div class="card">
        <div class="card-header"><h5><b>Pesquisa</b></h5></div>
        <div class="card-body">
            <form method="GET" action="/">
                <label><b>Filtros:</b></label><br>
                <div class="row form-group">
                    <div class="col-sm form-group">
                        <input type="text" class="form-control" name="busca" placeholder="Digite o nome do candidato, nome do orientador ou o título da tese" value="{{Request()->busca}}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header"><h2>Trabalhos Acadêmicos</h2></div>
        <table class="table table-striped" style="text-align:center;">
            <theader>
                <tr>
                    <th>Data da defesa</th>
                    <th>Curso</th>
                    <th>Nome</th>
                    <th>Título</th>
                    <th>Orientador(a)</th>
                </tr>
            </theader>
            <tbody>
            @foreach ($agendamentos as $agendamento)
                <tr>
                    <td>{{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y H:i') }}</td>
                    <td>{{ $graduacao::curso($agendamento->user->codpes, getenv('REPLICADO_CODUNDCLG'))['nomcur'] }}</td>
                    <td>@if($agendamento->returnLastFileId($agendamento->id))<a href="/agendamentos/{{ $agendamento->id }}"> @else <a href="#">@endif{{ $agendamento->user->name }}</a></td>
                    <td>{{ $agendamento->titulo }}</td>
                    <td>{{ $agendamento->nome_do_orientador }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $agendamentos->appends(request()->query())->links() }}
    </div>
@endsection('content')
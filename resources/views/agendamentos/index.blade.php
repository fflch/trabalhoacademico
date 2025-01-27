@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascripts_bottom')

@section('content')
    @include('flash')
    <div class="row" style="margin-bottom: 0.5em;">
        <div class="col-sm">
            <a href="/agendamentos/create" class="btn btn-primary">Agendar Trabalho Acadêmico</a>
        </div>
        <div class="col-g">
            @can("admin")
            <form method="post" action="excel">
                @csrf
                <button type="submit" class="btn btn-success"><i class="fas fa-file-export"></i> Baixar para Excel</button>
            </form>
            @endcan
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="GET" action="/agendamentos">
                <div class="row">
                    <div class="col-auto">
                        <label style="margin-top:0.35em; margin-bottom:0em;"><b>Filtros:</b></label>
                    </div>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" style="padding-bottom: 1em;">
                        <label class="btn btn-light">
                            <input type="radio" name="filtro_busca" id="numero_nome" value="numero_nome" autocomplete="off" @if(Request()->filtro_busca == 'numero_nome' or Request()->filtro_busca == '') checked @endif> Número USP/Nome
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="filtro_busca" id="data" value="data" autocomplete="off" @if(Request()->filtro_busca == 'data') checked @endif> Data
                        </label>
                    </div>
                    <div class="col-auto"> 
                        <select class="form-control" name="busca_status">
                            <option value="" selected="">- Status -</option>
                            @foreach (App\Models\Agendamento::statusOptions() as $option)
                                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                                @if (old('busca_status') == '' and isset(Request()->busca_status))
                                <option value="{{$option}}" {{ ( Request()->busca_status == $option) ? 'selected' : ''}}>
                                    {{$option}}
                                </option>
                                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                                @else
                                <option value="{{$option}}" {{ ( old('busca_status') == $option) ? 'selected' : ''}}>
                                    {{$option}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm" id="busca"  @if(Request()->filtro_busca == 'data') style="display:none;" @endif>
                        <input type="text" class="form-control busca" autocomplete="off" name="busca" value="{{ Request()->busca }}" placeholder="Digite o título do trabalho, o número USP, o nome do(a) candidato(a) ou nome do(a) orientador(a)">
                    </div>
                    <div class="col-sm" id="busca_data" @if(Request()->filtro_busca == 'numero_nome' or Request()->filtro_busca == '') style="display:none;" @endif>
                        <input class="form-control data datepicker" autocomplete="off" name="busca_data" value="{{ Request()->busca_data }}" placeholder="Selecione a data">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <theader>
            <tr>
                <th>Nº USP</th>
                <th>Nome</th>
                <th>Título</th>
                <th>Data da Defesa</th>
                <th>Orientador</th>
                <th>Status</th>
                <th colspan="2">Ações</th>
            </tr>
        </theader>
        <tbody>
        @foreach ($agendamentos as $agendamento)
            <tr>
                <td>{{ $agendamento->user->codpes }}</td>
                <td><a href="/agendamentos/{{$agendamento->id}}">{{ $agendamento->user->name }}</a></td>
                <td>{{ $agendamento->titulo }}</td>
                <td>{{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') }}</td>
                <td>{{ $agendamento->nome_do_orientador}}</td>
                <td>{{ $agendamento->status}}</td>
                <td>
                    @can('owner', $agendamento)
                        @if($agendamento->status == 'Em Elaboração' or $agendamento->status == 'Em Avaliação')
                            <a href="/agendamentos/{{$agendamento->id}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                        @endif
                    @endcan
                </td>
                <td>
                    @can('owner', $agendamento)
                        @if($agendamento->status == 'Em Elaboração')
                            <form method="POST" action="/agendamentos/{{ $agendamento->id }}">
                                @csrf 
                                @method('delete')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        @endif
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $agendamentos->appends(request()->query())->links() }}
@endsection('content')

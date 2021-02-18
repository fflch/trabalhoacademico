    <div class="card">
        <div class="card-header"><b>Banca</b></div>
        <div class="card-body form-group">
            @can('OWNER', $agendamento)
                @if($agendamento->status == 'Em Elaboração' or $agendamento->status == 'Em Avaliação')
                    @include('agendamentos.bancas.partials.form')
                @endif
            @endcan
            <table class="table table-striped" style="text-align: center;">
                <theader>
                    <tr>
                        @can('LOGADO')<th>Nº USP</th>@endcan
                        <th>Nome</th>
                        <th>Presidente</th>
                        @can('ADMIN')
                            <th>Ofício de Agendamento</th>
                            <th>Declaração de participação</th>
                        @endcan
                        @can('LOGADO')<th>Ações</th>@endcan
                    </tr>
                </theader>
                <tbody>
                @foreach ($agendamento->bancas as $banca)
                    <tr>
                        @can('LOGADO')<td>{{ $banca->n_usp ?? '' }}</td>@endcan
                        <td>@if($banca->n_usp){{ $pessoa::dump($banca->n_usp)['nompes']}}@else {{ $agendamento->dadosProfExterno($banca->prof_externo_id)['nome'] }}@endif</td>
                        <td>{{ $banca->presidente }}</td>
                        @can('ADMIN')
                            <td>
                                <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/oficio" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                            </td>
                            <td>
                                <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/declaracao" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                            </td>
                        @endcan
                        @can('OWNER', $agendamento)
                            <td>

                                @if($agendamento->status == 'Em Elaboração' or $agendamento->status == 'Em Avaliação')
                                    <form method="POST" class="form-group" action="/bancas/{{$banca->id}}">
                                        @csrf 
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                @endif
                            </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
 
 
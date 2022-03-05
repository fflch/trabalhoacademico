    <div class="card" style="margin-bottom: 0.5em;">
        <div class="card-header"><b>Arquivos</b></div>
        <div class="card-body">
            @can('owner', $agendamento)
                @if(($agendamento->status == 'Em Elaboração' and $agendamento->data_enviado_avaliacao == null) or ($agendamento->status == 'Aprovado C/ Correções' and $agendamento->data_enviado_correcao == null and $dias <= 60))
                    @include('agendamentos.files.partials.form')
                @endif
            @endcan 
            <br>
            <br>
            @can('view', $agendamento->files->where('tipo','trabalho')->first())
            <table class="table table-striped" style="text-align: center;">
                <theader>
                    <tr>
                        <th>Nome do Arquivo</th>
                        <th>Data de Envio</th>
                        <th>Status</th>
                        @can('owner', $agendamento)
                            @if(($agendamento->status == 'Em Elaboração' and $agendamento->data_enviado_avaliacao == null) or ($agendamento->status == 'Aprovado C/ Correções' and $agendamento->data_enviado_correcao == null))
                                <th>Ações</th>
                            @endif 
                        @endcan
                    </tr>
                </theader>
                <tbody>
                @foreach ($agendamento->files->where('tipo','trabalho') as $file)
                    <tr>
                        <td><a href="/files/{{$file->id}}">{{ $file->original_name }}</a></td>
                        <td>
                            {{ Carbon\Carbon::parse($file->created_at)->format('d/m/Y') }}
                        </td>
                        <td>{{ $agendamento->status }}</td>
                        @can('delete',$file)
                            @if(($agendamento->status == 'Em Elaboração' and $agendamento->data_enviado_avaliacao == null) or ($agendamento->status == 'Aprovado C/ Correções' and $agendamento->data_enviado_correcao == null))
                            <td>
                                <form method="POST" class="form-group" action="/files/{{$file->id}}">
                                    @csrf 
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                            @endif
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endcan
        </div>
    </div>
 
 
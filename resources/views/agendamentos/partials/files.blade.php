<div class="card">
        <div class="card-header"><b>Arquivos</b></div>
        <div class="card-body form-group">
            @can('OWNER', $agendamento)
                @if($agendamento->status == 'Em Elaboração' or ($agendamento->status == 'Aprovado C/ Correções' and \Carbon\Carbon::now()->lte(date('Y-m-d H:i:s', strtotime('+60 days', strtotime($agendamento->data_da_defesa))))))
                    @include('agendamentos.files.partials.form')
                @endif
            @elsecan('DOCENTE', $agendamento)
                @if($agendamento->status == 'Em Avaliação' and $agendamento->data_devolucao == null)
                    @include('agendamentos.files.partials.form')
                @endif
            @endcan 
            <br>
            <br>
            <table class="table table-striped" style="text-align: center;">
                <theader>
                    <tr>
                        <th>Nome do Arquivo</th>
                        <th>Data</th>
                        <th>Status</th>
                        @can('LOGADO')<th>Ações</th>@endcan
                    </tr>
                </theader>
                <tbody>
                @foreach ($agendamento->files->where('tipo','trabalho') as $file)
                    <tr>
                        <td><a href="/files/{{$file->id}}">{{ $file->original_name }}</a></td>
                        <td>
                            @if($agendamento->status == 'Em Elaboração')
                                {{ Carbon\Carbon::parse($file->created_at)->format('d/m/Y') }}
                            @elseif($agendamento->status == 'Em Avaliação')
                                {{ Carbon\Carbon::parse($file->data_enviado_avaliacao)->format('d/m/Y') }}
                            @elseif($agendamento->status == 'Aprovado C/ Correções')
                                {{ Carbon\Carbon::parse($file->data_devolucao)->format('d/m/Y') }}
                            @elseif($agendamento->status == 'Aprovado')
                                {{ Carbon\Carbon::parse($file->data_resultado)->format('d/m/Y') }}
                            @endif
                        </td>
                        <td>{{ $agendamento->status }}</td>
                        @can('OWNER', $agendamento)
                            <td>
                                @if(($agendamento->status == 'Em Elaboração' and $agendamento->data_enviado_avaliacao == null) or ($agendamento->status == 'Aprovado C/ Correções' and \Carbon\Carbon::now()->lte(date('Y-m-d H:i:s', strtotime('+60 days', strtotime($agendamento->data_da_defesa))))))
                                    <form method="POST" class="form-group" action="/files/{{$file->id}}">
                                        @csrf 
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                @endif
                            </td>
                        @elsecan('DOCENTE', $agendamento)
                            <td>
                                @if($agendamento->status == 'Em Elaboração' and $agendamento->data_enviado_avaliacao == null)
                                    <form method="POST" class="form-group" action="/files/{{$file->id}}">
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
 
 
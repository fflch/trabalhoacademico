<div class="card">
        <div class="card-header"><b>Arquivos</b></div>
        <div class="card-body form-group">
            @can('OWNER', $agendamento)
                @if(($agendamento->status == 'Em Elaboração' and $agendamento->data_enviado_avaliacao == null) or ($agendamento->status == 'Aprovado C/ Correções' and $agendamento->data_enviado_correcao == null))
                    @include('agendamentos.files.partials.form')
                @endif
            @elsecan('DOCENTE', $agendamento)
                @if($agendamento->status == 'Em Avaliação' and $agendamento->data_devolucao == null)
                    @include('agendamentos.files.partials.form')
                @endif
            @endcan 
            <br>
            <br>
            @if(Auth::check() == true or (Auth::check() == false and $agendamento->status == 'Aprovado'))
            <table class="table table-striped" style="text-align: center;">
                <theader>
                    <tr>
                        <th>Nome do Arquivo</th>
                        <th>Data de Envio</th>
                        <th>Status</th>
                        @can('OWNER', $agendamento)<th>Ações</th>@endcan
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
                        @can('OWNER', $agendamento)
                            @if(($agendamento->status == 'Em Elaboração' and $agendamento->data_enviado_avaliacao == null) or ($agendamento->status == 'Aprovado C/ Correções' and \Carbon\Carbon::now()->lte(date('Y-m-d H:i:s', strtotime('+60 days', strtotime($agendamento->data_da_defesa))))))
                                <td>
                                    <form method="POST" class="form-group" action="/files/{{$file->id}}">
                                        @csrf 
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            @endif
                        @elsecan('DOCENTE', $agendamento)
                            @if($agendamento->status == 'Em Elaboração' and $agendamento->data_enviado_avaliacao == null)
                                <td>
                                    <form method="POST" class="form-group" action="/files/{{$file->id}}">
                                        @csrf 
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            @endif
                        @endcan

                        @can('delete',$file)
                        <td>
                            <form method="POST" class="form-group" action="/files/{{$file->id}}">
                                @csrf 
                                @method('delete')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
 
 
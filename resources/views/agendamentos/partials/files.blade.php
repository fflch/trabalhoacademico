<div class="card">
        <div class="card-header"><b>Arquivos</b></div>
        <div class="card-body form-group">
            @if($agendamento->status == 'Em Elaboração' or $agendamento->status == 'Devolvido')
                @include('agendamentos.files.partials.form')
            @endif
            <br>
            <br>
            <table class="table table-striped" style="text-align: center;">
                <theader>
                    <tr>
                        <th>Nome do Arquivo</th>
                        <th>Data de Envio</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </theader>
                <tbody>
                @foreach ($agendamento->files as $file)
                    <tr>
                        <td><a href="/files/{{$file->id}}">{{ $file->original_name }}</a></td>
                        <td>
                            @if($agendamento->status == 'Em Elaboração')
                                {{ Carbon\Carbon::parse($file->created_at)->format('d/m/Y') }}
                            @elseif($agendamento->status == 'Em Avaliação')
                                {{ Carbon\Carbon::parse($file->data_enviado_avaliacao)->format('d/m/Y') }}
                            @elseif($agendamento->status == 'Devolvido')
                                {{ Carbon\Carbon::parse($file->data_devolucao)->format('d/m/Y') }}
                            @elseif($agendamento->status) == 'Aprovado')
                                {{ Carbon\Carbon::parse($file->data_aprovado)->format('d/m/Y') }}
                            @endif
                        </td>
                        <td>{{ $agendamento->status }}</td>
                        <td>
                            @if($agendamento->status == 'Em Elaboração' or $agendamento->status == 'Devolvido')
                                <form method="POST" class="form-group" action="/files/{{$file->id}}">
                                    @csrf 
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
 
 
    <div class="card" style="margin-bottom: 0.5em;">
        <div class="card-header"><b>Documentos Gerais</b></div>
        <table class="table table-striped">
            <tbody>
                @can('DOCENTE', $agendamento)
                    @if($agendamento->status == 'Aprovado' or $agendamento->status == 'Aprovado C/ Correções')
                        <tr>
                            <td>
                                Ata da Defesa
                            </td>
                            <td>
                                <a href="/agendamentos/{{$agendamento->id}}/ata" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                            </td>
                        </tr>
                    @endif
                @elsecan('OWNER', $agendamento)
                    @if($agendamento->status == 'Aprovado' or $agendamento->status == 'Aprovado C/ Correções')
                        <tr>
                            <td>
                                Ata da Defesa
                            </td>
                            <td>
                                <a href="/agendamentos/{{$agendamento->id}}/ata" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                            </td>
                        </tr>
                    @endif
                @endcan
                @can('OWNER', $agendamento)
                    <tr>
                        <td>
                            Placa
                        </td>
                        <td>
                            <a href="/agendamentos/{{$agendamento->id}}/placa" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                        </td>
                    </tr>
                @endcan
                @can('DOCENTE', $agendamento)
                    <tr>
                        <td>
                            Ofícios de Agendamento
                        </td>
                        <td>
                            <a href="/agendamentos/{{$agendamento->id}}/oficios" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Declaração de Participação
                        </td>
                        <td>
                            <a href="/agendamentos/{{$agendamento->id}}/declaracoes" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                        </td>
                    </tr>
                @endcan
                @can('OWNER', $agendamento)
                    @if($agendamento->files->where('tipo', 'ata')->first())
                    <tr>
                        <td>
                            Parecer da Defesa
                        </td>
                        <td>
                            <a href="/files/{{$agendamento->files->where('tipo', 'ata')->first()->id}}" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                        </td>
                    </tr>
                    @endif
                @endcan
            </tbody>
        </table>
        @can('DOCENTE', $agendamento)
            <div class="card">
                <div class="card-header">Parecer da Defesa</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <form action="/files" enctype="multipart/form-data" method="POST">
                                <span class="badge badge-danger"><b>Cuidado:</b> A cada novo upload, o novo arquivo irá sobrescrever o arquivo anterior.</span><br>
                                <input type="file" class="form-control-file" id="ata-da-defesa" name="file"><br>
                                @csrf
                                <input type="hidden" name="agendamento_id" value="{{$agendamento->id}}">
                                <input type="hidden" name="tipo" value="ata">
                                <input type="hidden" name="status" value="{{$agendamento->status}}">
                        </div>
                        <div class="col-auto float-right">
                                <button type="submit" class="btn btn-success">Enviar</button> 
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <ul>
                            @foreach ($agendamento->files->where('tipo', 'ata') as $file)
                                <li>
                                    <div class="row"> 
                                        <div class="col-auto">
                                            <a href="/files/{{$file->id}}">{{ $file->original_name }}</a>
                                        </div>
                                        <div class="col-auto">
                                            <form method="POST" class="form-group" action="/files/{{$file->id}}">
                                                @csrf 
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </li>    
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endcan
    </div>
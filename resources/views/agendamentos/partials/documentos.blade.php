    <div class="card">
        <div class="card-header"><b>Documentos Gerais</b></div>
        <table class="table table-striped">
            <tbody>
                @can('ADMIN')
                    <tr>
                        <td>
                            Ata da Defesa
                        </td>
                        <td>
                            <a href="/agendamentos/{{$agendamento->id}}/ata" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                        </td>
                    </tr>
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
                @can('ADMIN')
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
            </tbody>
        </table>
        @can('OWNER', $agendamento)
            <div class="card-body">
                <div class="card">
                    <div class="card-header">Ata da Defesa Assinada</div>
                    <div class="card-body">
                        @can('ADMIN')
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
                                        <br>
                                        <button type="submit" class="btn btn-success">Enviar</button> 
                                    </form>
                                </div>
                            </div>
                        @endcan
                        <div class="row">
                            <ul>
                                @foreach ($agendamento->files->where('tipo', 'ata') as $file)
                                    <div class="row"> 
                                        <div class="col-auto">
                                            <li><a href="/files/{{$file->id}}">{{ $file->original_name }}</a></li>
                                        </div>
                                        @can('ADMIN')
                                            <div class="col-auto">
                                                <form method="POST" class="form-group" action="/files/{{$file->id}}">
                                                    @csrf 
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                        @endcan
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
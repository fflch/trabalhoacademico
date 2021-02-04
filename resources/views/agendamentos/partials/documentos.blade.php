    <div class="card">
        <div class="card-header"><b>Documentos Gerais</b></div>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>
                        Placa
                    </td>
                    <td>
                        <a href="/agendamentos/{{$agendamento->id}}/placa" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Etiquetas
                    </td>
                    <td>
                        <a href="/agendamentos/{{$agendamento->id}}/etiqueta" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
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
                <tr>
                    <td>
                        Recibos de remessa de documentos para docentes USP                    
                    </td>
                    <td>
                        <a href="/agendamentos/{{$agendamento->id}}/recibos" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
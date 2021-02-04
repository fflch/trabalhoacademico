<div class="row">
    <div class="col-sm">
        <div class="row float-left">
            @can('LOGADO')
                <div class="col-auto">
                    <a href="/agendamentos/create" class="btn btn-primary">Agendar Novo Trabalho Acadêmico</a>
                </div>
            @endcan
            @can('OWNER', $agendamento)
                @if(($agendamento->status == 'Em Elaboração' or $agendamento->status == 'Devolvido') and $agendamento->files()->count() != 0)
                    <div class="col-auto">
                        <form method="POST" action="/agendamentos/enviar_avaliacao/{{ $agendamento->id }}">
                            @csrf 
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja enviar para Avaliação?')"> Enviar para Avaliação do(a) orientador(a) </button>
                        </form>
                    </div>
                @endif
            @endcan
            @can('DOCENTE', $agendamento)
                @if($agendamento->status == 'Em Avaliação' and $agendamento->files()->count() != 0 and $agendamento->data_devolucao == null)
                    <div class="col-auto">
                        <form method="POST" action="/agendamentos/devolver_avaliacao/{{ $agendamento->id }}">
                            @csrf 
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja devolver a Avaliação?')"> Devolver Avaliação para o(a) aluno(a) </button>
                        </form>
                    </div>
                @endif
            @endcan
        </div>
    </div>
    <div class="col-sm ">
        <div class="row float-right">
            @can('OWNER', $agendamento)
                @if($agendamento->status == 'Em Elaboração' or $agendamento->status == 'Devolvido')
                    <div class="col-auto">
                        <a href="/agendamentos/{{$agendamento->id}}/edit" class="btn btn-warning">Editar Trabalho Acadêmico</a>
                    </div>
                @endif
                @if($agendamento->status == 'Em Elaboração')
                <div class="col-auto">
                    <form method="POST" action="/agendamentos/{{ $agendamento->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
                    </form>
                </div>
                @endif
            @endcan
            @can('DOCENTE', $agendamento)
                @if($agendamento->status == 'Em Avaliação' and $agendamento->data_devolucao != '')
                    <div class="col-auto">
                        <form method="POST" action="/agendamentos/aprovacao/{{ $agendamento->id }}/aprovar">
                            @csrf 
                            <button type="submit" class="btn btn-success" onclick="return confirm('Tem certeza que deseja aprovar a defesa?')"> Aprovar </button>
                        </form>
                    </div>
                @endif
                @if($agendamento->status == 'Em Avaliação' and $agendamento->data_devolucao != '')
                    <div class="col-auto">
                        <form method="POST" action="/agendamentos/aprovacao/{{ $agendamento->id }}/reprovar">
                            @csrf 
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja reprovar a defesa?')"> Reprovar </button>
                        </form>
                    </div>
                @endif
            @endcan
        </div>
    </div>
</div>
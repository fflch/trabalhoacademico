<div class="row">
    <div class="col-sm">
        <div class="row float-left">
            <div class="col-auto">
                <a href="/agendamentos/create" class="btn btn-success">Agendar Novo Trabalho Acadêmico</a>
            </div>
            @if($agendamento->status == 'Em Elaboração' and $agendamento->files()->count() != 0)
                <div class="col-auto">
                    <form method="POST" action="/agendamentos/enviar_avaliacao/{{ $agendamento->id }}">
                        @csrf 
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja enviar para Avaliação?')"> Enviar para Avaliação do(a) orientador(a) </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
    <div class="col-sm ">
        <div class="row float-right">
            @if($agendamento->status == 'Em elaboração' or $agendamento->status == 'Devolvido')
                <div class="col-auto">
                    <a href="/agendamentos/{{$agendamento->id}}/edit" class="btn btn-warning">Editar Trabalho Acadêmico</a>
                </div>
            @endif
            @if($agendamento->status == 'Em elaboração')
            <div class="col-auto">
                <form method="POST" action="/agendamentos/{{ $agendamento->id }}">
                    @csrf 
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
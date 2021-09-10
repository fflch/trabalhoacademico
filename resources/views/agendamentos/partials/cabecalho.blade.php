<div class="row" style="margin-bottom: 0.5em;">
    <div class="col-sm">
        <div class="row float-left">
            @can('LOGADO')
                <div class="col-auto">
                    <a href="/agendamentos/create" class="btn btn-primary">Agendar Novo Trabalho Acadêmico</a>
                </div>
            @endcan
            @can('OWNER', $agendamento)
                @if($agendamento->data_enviado_avaliacao == null and $agendamento->files()->where('tipo', 'trabalho')->count() != 0 and $agendamento->status == 'Em Elaboração')
                    <div class="col-auto">
                        <form method="POST" action="/agendamentos/enviar_avaliacao/{{ $agendamento->id }}">
                            @csrf 
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja enviar para Avaliação?')"> Enviar para Avaliação do(a) orientador(a) </button>
                        </form>
                    </div>
                @elseif($agendamento->status == 'Aprovado C/ Correções' and $agendamento->data_enviado_correcao == null)
                    <div class="col-auto">
                        <form method="POST" action="/agendamentos/enviar_correcao/{{ $agendamento->id }}">
                            @csrf 
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja enviar para Avaliação?')"> Enviar Correção </button>
                        </form>
                    </div>
                @endif
            @endcan
        </div>
    </div>
    <div class="col-sm ">
        <div class="row float-right">
            @can('OWNER', $agendamento)
                @if($agendamento->status != 'Aprovado' and $agendamento->status != 'Reprovado' and $agendamento->status != 'Aprovado C/ Correções')
                    <div class="col-auto">
                        <a href="/agendamentos/{{$agendamento->id}}/edit" class="btn btn-warning">Editar Trabalho Acadêmico</a>
                    </div>
                @endif
                @if(($agendamento->status == 'Em Elaboração' and $agendamento->data_enviado_avaliacao == null) or (Auth::user()->can('ADMIN')))
                <div class="col-auto">
                    <form method="POST" action="/agendamentos/{{ $agendamento->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
                    </form>
                </div>
                @endif
            @endcan
        </div>
    </div>
</div>


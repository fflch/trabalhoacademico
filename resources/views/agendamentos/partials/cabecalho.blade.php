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
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        @can('DOCENTE', $agendamento)
            @if($agendamento->status == 'Em Avaliação' and $agendamento->files()->count() != 0)
                <br>
                <div class="card">
                    <div class="card-header"><b>Comentário:</b></div>
                    <form method="POST" action="/agendamentos/resultado/{{ $agendamento->id }}">
                        @csrf 
                        <textarea class="form-control" name="comentario" id="comentario" rows="5" cols="60">{{ old('comentario', $agendamento->comentario) }}</textarea>
                        <div class="card-body row">
                            <div class="col-auto">
                                <input type="submit" name="devolver" value="Devolver Avaliação para o(a) aluno(a)" class="btn btn-warning" onclick="return confirm('Tem certeza que deseja devolver a Avaliação?')">
                            </div>
                            <div class="col-auto"> 
                                <input type="submit" name="aprovar" value="Aprovar" class="btn btn-success" onclick="return confirm('Tem certeza que deseja aprovar a defesa?')">
                            </div>
                            <div class="col-auto">
                                <input type="submit" name="reprovar" value="Reprovar" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja reprovar a defesa?')">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @endcan
        @can('OWNER', $agendamento)
            @if($agendamento->comentario != '')
                <br>
                <div class="card">
                    <div class="card-header"><b>Comentário:</b></div>
                    <div class="card-body">
                        {{$agendamento->comentario}}
                    </div>
                </div>
            @endif
        @endcan
    </div>
</div>
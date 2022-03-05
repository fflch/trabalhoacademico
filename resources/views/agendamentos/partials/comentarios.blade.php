<div class="row" style="margin-bottom: 0.5em;">
    <div class="col-sm">
        @can('docente', $agendamento)
            @if(($agendamento->data_enviado_avaliacao != null and $agendamento->data_liberacao != null and $agendamento->status == 'Em Avaliação') or ($agendamento->data_enviado_correcao != null and $agendamento->status == 'Aprovado C/ Correções'))
                <br>
                <div class="card">
                    <div class="card-header"><b>Parecer da defesa:</b></div>
                    <form method="POST" action="/agendamentos/resultado/{{ $agendamento->id }}">
                        @csrf
                        <div class="card-body form-group">
                            <div class="row">
                                <div class="col-sm form-group"> 
                                    <textarea class="form-control" name="parecer" id="parecer" rows="5" cols="60">{{ old('parecer', $agendamento->parecer) }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div style="padding-left:15px; padding-right:0px;padding-top:5px;">
                                    <label for="nota"><b>Nota:</b></label>                                
                                </div>
                                <div class="col-auto form-group" style="padding-left:2px;">
                                    <input type="text" class="form-control col-3" maxlength="3" name="nota" value="{{ old('nota', $agendamento->nota) }}">
                                </div>
                            </div>
                            <div class="row">
                                @if(($agendamento->data_enviado_correcao == null or $agendamento->data_resultado == null) and $agendamento->data_devolucao == null)
                                    <div class="col-auto">
                                        <input type="submit" name="devolver" value="Aprovar com correções" class="btn btn-warning" onclick="return confirm('Tem certeza que deseja aprovar a defesa e devolver ao aluno(a) para fazer as correções?')">
                                    </div>
                                @endif
                                <div class="col-auto"> 
                                    <input type="submit" name="aprovar" value="Aprovar" class="btn btn-success" onclick="return confirm('Tem certeza que deseja aprovar a defesa?')">
                                </div>
                                <div class="col-auto">
                                    <input type="submit" name="reprovar" value="Reprovar" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja reprovar a defesa?')">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @endcan
        @can('owner', $agendamento)
            @if($agendamento->parecer != '' and ($agendamento->status == 'Aprovado' or $agendamento->status == 'Aprovado C/ Correções' or $agendamento->status == 'Reprovado'))
                <br>
                <div class="card">
                    <div class="card-header"><b>Parecer:</b></div>
                    <div class="card-body">
                        {{$agendamento->parecer}}
                    </div>
                </div>
            @endif
        @endcan
        @can('docente', $agendamento)
            @if($agendamento->status == 'Em Elaboração' and $agendamento->files()->count() != 0 and $agendamento->data_enviado_avaliacao != null)
                <br>
                <div class="card">
                    <div class="card-header"><b>Comentário:</b></div>
                    <form method="POST" action="/agendamentos/liberar/{{ $agendamento->id }}">
                        @csrf 
                        <textarea class="form-control" name="comentario" id="comentario" rows="5" cols="60">{{ old('comentario', $agendamento->comentario) }}</textarea>
                        <div class="card-body row">
                            <div class="col-auto">
                                <input type="submit" name="devolver" value="Enviar Defesa para Avaliação da Banca" class="btn btn-warning" onclick="return confirm('Tem certeza que deseja enviar defesa para avaliação da banca?')">
                            </div>
                            <div class="col-auto">
                                <input type="submit" name="devolver" value="Devolver para o Aluno" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja devolver a defesa para o aluno?')">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @endcan
        @can('owner', $agendamento)
            @if($agendamento->comentario != '' and ($agendamento->status != 'Aprovado' and $agendamento->status != 'Aprovado C/ Correções'))
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
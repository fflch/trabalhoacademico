        @if($agendamento->status == 'Aprovado')
            <form method='post' action='agendamentos/publicar/{{$agendamento->id}}'>
                @csrf
                <div class="card">
                    <div class="card-header">Publicação</div>
                    <div class="card-body">
                        <b>Publicar?</b>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="publicado" id="publicado1" value="Sim" @if($agendamento->publicado == 'Sim' or $agendamento->publicado == '') checked @endif>
                            <label class="form-check-label" for="publicado1">
                                Sim
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="publicado" id="publicado2" value="Não" @if($agendamento->publicado == 'Não') checked @endif>
                            <label class="form-check-label" for="publicado2">
                                Não
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="url_biblioteca" class="required"><b>URL:</b></label>
                            <input type="text" class="form-control" name="url_biblioteca" value="{{ old('url_biblioteca', $agendamento->url_biblioteca) }}">
                        </div>  
                        <div class="form-group">
                            <button type="submit" class="btn btn-success float-right">Enviar</button> 
                        </div>               
                    </div>
                </div>
            </form>
        @endif

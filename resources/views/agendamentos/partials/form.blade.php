        <div class="card">
            <div class="card-header"><b>Dados Pessoais</b></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nome" class="required"><b>Nome</b></label>
                    <input type="text" class="form-control" name="nome" value="{{ old('nome', $agendamento->nome) }}">
                </div>
                <div class="form-group">
                    <label for="codpes" class="required"><b>Número USP</b></label>
                    <input type="text" class="form-control" name="codpes" value="{{ old('codpes', $agendamento->codpes) }}">
                </div>
                <div class="card form-group">
                    <div class="card-header"><b>E-mails</b></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="e_mail_usp" class="required"><b>E-mail USP</b></label>
                            <input type="text" class="form-control" name="e_mail_usp" value="{{ old('e_mail_usp', $agendamento->e_mail_usp) }}">
                        </div>
                        <div class="form-group">
                            <label for="outro_recomendado_"><b>Outro (Recomendado)</b></label>
                            <input type="text" class="form-control" name="outro_recomendado_" value="{{ old('outro_recomendado_', $agendamento->outro_recomendado_) }}">
                        </div>
                        <div class="form-group">
                            <label for="divulgar_e_mail_" class="required"><b>Divulgar E-mail?</b></label>
                            <select class="form-control" name="divulgar_e_mail_">
                                <option value="" selected="">- Selecione -</option>
                                @foreach ($agendamento->divulgaOptions() as $option)
                                    {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                                    @if (old('divulgar_e_mail_') == '' and isset($agendamento->divulgar_e_mail_))
                                    <option value="{{$option}}" {{ ( $agendamento->divulgar_e_mail_ == $option) ? 'selected' : ''}}>
                                        {{$option}}
                                    </option>
                                    {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                                    @else
                                    <option value="{{$option}}" {{ ( old('divulgar_e_mail_') == $option) ? 'selected' : ''}}>
                                        {{$option}}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <br>
         <div class="card">
            <div class="card-header"><b>Dados do trabalho acadêmico</b></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="status" class="required"><b>Status</b></label>
                    <select class="form-control" name="status">
                        <option value="" selected="">- Selecione -</option>
                        @foreach ($agendamento->statusOptions() as $option)
                            {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                            @if (old('status') == '' and isset($agendamento->status))
                            <option value="{{$option}}" {{ ( $agendamento->status == $option) ? 'selected' : ''}}>
                                {{$option}}
                            </option>
                            {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                            @else
                            <option value="{{$option}}" {{ ( old('status') == $option) ? 'selected' : ''}}>
                                {{$option}}
                            </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="titulo" class="required"><b>Título</b></label>
                    <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $agendamento->titulo) }}">
                </div>
                <div class="form-group">
                    <label for="resumo" class="required"><b>Resumo</b></label>
                    <textarea class="form-control" name="resumo" id="resumo" rows="5" cols="60">{{ old('resumo', $agendamento->resumo) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="palavras_chave"class="required"><b>Palavras-Chave</b></label>
                    <input type="text" class="form-control" name="palavras_chave" value="{{ old('palavras_chave', $agendamento->palavras_chave) }}">
                </div>
                <div class="form-group">
                    <label for="abstract"><b>Abstract</b></label>
                    <textarea class="form-control" name="abstract" id="abstract" rows="5" cols="60"></textarea>
                </div>
                <div class="form-group">
                    <label for="data_da_defesa" class="required"><b>Data da Defesa</b></label>
                    <input type="text" class="form-control datepicker" name="data_da_defesa" value="{{ old('data_da_defesa', Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y')) }}">
                </div>
                <div class="card">
                    <div class="card-header"><b>Dados do Orientador</b></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nome_do_orientador" class="required"><b>Nome do Orientador</b></label>
                            <input type="text" class="form-control" name="nome_do_orientador" value="{{ old('nome_do_orientador', $agendamento->nome_do_orientador) }}">
                        </div>
                        <div class="form-group">
                            <label for="numero_usp_do_orientador" class="required"><b>Número USP do Orientador</b></label>
                            <input type="text" class="form-control" name="numero_usp_do_orientador" value="{{ old('numero_usp_do_orientador', $agendamento->numero_usp_do_orientador) }}">
                        </div>
                        <div class="form-group">
                            <div>
                                <label class="required"><b>Co-Orientador?</b></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="co_orientador" id="co-orientador-sim" value="Sim" checked>
                                <label class="form-check-label" for="co-orientador-sim">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="co_orientador" id="co-orientador-nao" value="Não">
                                <label class="form-check-label" for="co-orientador-nao">
                                    Não
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-success float-right">Enviar</button> 
        </div> 
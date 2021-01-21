        <div class="card">
            <div class="card-header"><b>Dados Pessoais</b></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" value="{{ old('nome', $agendamento->nome) }}">
                </div>
                <div class="card form-group">
                    <div class="card-header">E-mails</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="e_mail_usp">E-mail USP</label>
                            <input type="text" class="form-control" name="e_mail_usp" value="{{ old('e_mail_usp', $agendamento->e_mail_usp) }}">
                        </div>
                        <div class="form-group">
                            <label for="outro_recomendado_">Outro (Recomendado)</label>
                            <input type="text" class="form-control" name="outro_recomendado_" value="{{ old('outro_recomendado_', $agendamento->outro_recomendado_) }}">
                        </div>
                        <div class="form-group">
                            <label for="divulgar_e_mail_">Divulgar E-mail?</label>
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
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $agendamento->titulo) }}">
                </div>
                <div class="form-group">
                    <label for="resumo">Resumo</label>
                    <textarea class="form-control" name="resumo" id="resumo" rows="5" cols="60">{{ old('resumo', $agendamento->resumo) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="palavras_chave">Palavras-Chave</label>
                    <input type="text" class="form-control" name="palavras_chave" value="{{ old('palavras_chave', $agendamento->palavras_chave) }}">
                </div>
                <div class="form-group">
                    <label for="abstract">Abstract</label>
                    <textarea class="form-control" name="abstract" id="abstract" rows="5" cols="60"></textarea>
                </div>
                <div class="form-group">
                    <label for="data_da_defesa">Data da Defesa</label>
                    <input type="text" class="form-control datepicker" name="data_da_defesa" value="{{ old('data_da_defesa', $agendamento->data_da_defesa) }}">
                </div>
                <div class="card">
                    <div class="card-header">Dados do Orientador</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nome_do_orientador">Nome do Orientador</label>
                            <input type="text" class="form-control" name="nome_do_orientador" value="{{ old('nome_do_orientador', $agendamento->nome_do_orientador) }}">
                        </div>
                        <div class="form-group">
                            <label for="numero_usp_do_orientador">Número USP do Orientador</label>
                            <input type="text" class="form-control" name="numero_usp_do_orientador" value="{{ old('numero_usp_do_orientador', $agendamento->numero_usp_do_orientador) }}">
                        </div>
                        <div class="form-group">
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
            <p><span style="font-size:16px; text-align:justify"><span style="color:rgb(38, 50, 56); font-family:arial,sans-serif">Com fundamento no disposto na Lei nº 9.610, de 19 de fevereiro de 1998, <strong>autorizo</strong> a Faculdade de Filosofia Letras e Ciências Humanas da Universidade de São Paulo a publicar, em ambiente digital institucional e sem ressarcimento dos direitos autorais, o texto integral da obra acima citada, em formato PDF e a título de divulgação da produção acadêmica de graduação e especialização gerada pela Faculdade.</span></span></p>
        </div>
        <div class="form-group">
            <label for="arquivo-do-trabalho">Arquivo do Trabalho</label>
            <input type="file" class="form-control-file" id="arquivo-do-trabalho" name="files[arquivo_do_trabalho]">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success float-right">Enviar</button> 
        </div> 
        @csrf
        <div class="card" style="margin-bottom: 0.5em;">
            <div class="card-header"><b>Dados Pessoais</b></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nome"><b>Nome:</b></label> {{$agendamento->user->name ?? Auth::user()->name}}
                    <input type="text" hidden class="form-control" name="user_id" value=""><br>
                    <label for="codpes"><b>Número USP:</b></label> {{$agendamento->user->codpes ?? Auth::user()->codpes}}
                </div>
                <div class="card form-group">
                    <div class="card-header"><b>E-mails</b></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="e_mail_usp"><b>E-mail USP:</b></label> {{$agendamento->user->email ?? Auth::user()->email}}
                        </div>
                        <div class="form-group">
                            <label for="outro_recomendado_"><b>Outro (Recomendado)</b></label>
                            <input type="text" class="form-control" name="outro_recomendado_" value="{{ old('outro_recomendado_', $agendamento->outro_recomendado_) }}" @if($agendamento->status == 'Aprovado')readonly @endif>
                        </div>
                        <div class="form-group">
                            <label for="divulgar_e_mail_" class="required"><b>Divulgar E-mail?</b></label>
                            <select class="form-control" name="divulgar_e_mail_" @if($agendamento->status == 'Aprovado')readonly @endif>
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
        <div class="card" style="margin-bottom: 0.5em;">
            <div class="card-header"><b>Dados do trabalho acadêmico</b></div>
            <div class="card-body">
                <input type="text" hidden name="status" value="">
                <input type="text" hidden name="curso" value="">
                @can('admin')
                    <div class="form-group">
                        <label for="curso" class="required"><b>Curso</b></label>
                        <input type="text" class="form-control" name="curso" value="{{ old('curso', $agendamento->curso) }}">
                    </div>
                @endcan
                <div class="form-group">
                    <label for="tipo" class="required"><b>Modalidade de Defesa</b></label>
                    <select class="form-control" name="tipo" @if($agendamento->status == 'Aprovado')readonly @endif>
                        <option value="" selected="">- Selecione -</option>
                        @foreach ($agendamento->tipoOptions() as $option)
                            {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                            @if (old('tipo') == '' and isset($agendamento->tipo))
                            <option value="{{$option ?? ''}}" {{ ( $agendamento->tipo == $option) ? 'selected' : ''}}>
                                {{$option ?? ''}}
                            </option>
                            {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                            @else
                            <option value="{{$option ?? ''}}" {{ ( old('tipo') == $option) ? 'selected' : ''}}>
                                {{$option ?? ''}}
                            </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="titulo" class="required"><b>Título</b></label>
                    <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $agendamento->titulo) }}" @if($agendamento->status == 'Aprovado')readonly @endif>
                </div>
                <div class="form-group">
                    <label for="resumo" class="required"><b>Resumo</b></label>
                    <textarea class="form-control" name="resumo" id="resumo" rows="5" cols="60" @if($agendamento->status == 'Aprovado')readonly @endif>{{ old('resumo', $agendamento->resumo) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="palavras_chave"class="required"><b>Palavras-Chave</b></label>
                    <input type="text" class="form-control" name="palavras_chave" value="{{ old('palavras_chave', $agendamento->palavras_chave) }}" @if($agendamento->status == 'Aprovado')readonly @endif>
                </div>
                <div class="form-group">
                    <label for="titulo_ingles"><b>Título em Inglês</b></label>
                    <input type="text" class="form-control" name="titulo_ingles" value="{{ old('titulo_ingles', $agendamento->titulo_ingles) }}" @if($agendamento->status == 'Aprovado')readonly @endif>
                </div>
                <div class="form-group">
                    <label for="keywords"><b>Keywords</b></label>
                    <input type="text" class="form-control" name="keywords" value="{{ old('keywords', $agendamento->keywords) }}" @if($agendamento->status == 'Aprovado')readonly @endif>
                </div>
                <div class="form-group">
                    <label for="abstract"><b>Abstract</b></label>
                    <textarea class="form-control" name="abstract" id="abstract" rows="5" cols="60" @if($agendamento->status == 'Aprovado')readonly @endif>{{ old('abstract', $agendamento->abstract) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="data_da_defesa" class="required"><b>Data da Defesa</b></label>
                    <input type="text" class="form-control datepicker" name="data_da_defesa" value="{{ old('data_da_defesa', Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y')) }}" @if($agendamento->status == 'Aprovado')readonly @endif>
                </div>
                <div class="form-group">
                    <label for="horario"><b>Horário da Defesa</b></label>
                    <input type="text" class="form-control horario" name="horario" id="horario" value="{{ old('horario', Carbon\Carbon::parse($agendamento->data_da_defesa)->format('H:i')) }}" @if($agendamento->status == 'Aprovado')readonly @endif>
                </div>
                <div class="form-group">
                    <label for="sala" class="required"><b>Local da Defesa</b></label>
                    <input type="text" class="form-control" name="sala" value="{{ old('sala', $agendamento->sala) }}" @if($agendamento->status == 'Aprovado')readonly @endif>
                </div>
                <div class="card">
                    <div class="card-header"><b>Dados do Orientador</b></div>
                    <div class="card-body">            
                        <div class="form-group">
                            <label for="numero_usp_do_orientador" class="required"><b>Orientador</b></label>
                            <select class="form-control" name="numero_usp_do_orientador" @if($agendamento->status == 'Aprovado')readonly @endif>
                                <option value="" selected="">- Selecione -</option>
                                @foreach ($agendamento->docentes() as $option)
                                    {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                                    @if (old('numero_usp_do_orientador') == '' and isset($agendamento->numero_usp_do_orientador))
                                    <option value="{{$option['codpes'] ?? ''}}" {{ ( $agendamento->numero_usp_do_orientador == $option['codpes']) ? 'selected' : ''}}>
                                        {{$option['nompes'] ?? ''}}
                                    </option>
                                    {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                                    @else
                                    <option value="{{$option['codpes'] ?? ''}}" {{ ( old('numero_usp_do_orientador') == $option['codpes']) ? 'selected' : ''}}>
                                        {{$option['nompes'] ?? ''}}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success float-right">Enviar</button> 
        </div> 
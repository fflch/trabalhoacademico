    <div class="card" style="margin-bottom: 0.5em;">
        <div class="card-header"><b>Dados do Trabalho Acadêmico</b></div>
        <div class="card-body">
            <b>Modalidade:</b> {{$agendamento->tipo ?? 'Não informada'}}</br>
            @if($agendamento->publicado == 'Sim')<b>URL da Publicação:</b> {{$agendamento->url_biblioteca}}<br>@endif
            <b>Curso:</b> {{$agendamento->curso}}</br>
            <b>Título:</b> {{$agendamento->titulo}}</br>
            <b>Resumo:</b> <p style="text-align:justify; margin-bottom:0px;">{{$agendamento->resumo }} </p>
            <b>Palavras-chave:</b> {{ $agendamento->palavras_chave }}<br>
            @if($agendamento->titulo_ingles)
                <b>Título em Inglês:</b> {{$agendamento->titulo_ingles}}</br>
                <b>Abstract:</b> <p style="text-align:justify; margin-bottom:0px;">{{$agendamento->abstract}}</p>
                <b>Keywords:</b> {{ $agendamento->keywords }}<br>
            @endif
            <b>Data:</b> {{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') }}</br>
            <b>Horário:</b> {{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('H:i') }}</br>
            <b>Sala:</b> {{ $agendamento->sala }}</br></br>
            <div class="card">
                <div class="card-header">Dados do Orientador</div>
                <div class="card-body">
                    <b>Nome do Orientador:</b> {{$agendamento->nome_do_orientador}}</br>
                    @can('logado')<b>Número USP do orientador:</b> {{$agendamento->numero_usp_do_orientador}}</br>@endcan
                </div>
            </div>
        </div>
    </div>
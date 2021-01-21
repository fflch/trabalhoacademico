    <div class="card">
        <div class="card-header"><b>Dados do Trabalho Acadêmico</b></div>
        <div class="card-body">
            <b>Título:</b> {{$agendamento->titulo}}</br>
            <b>Resumo:</b> {{$agendamento->resumo }} </br>
            <b>Palavras-chave:</b> {{ $agendamento->palavras_chave }}</br>
            <b>Abstract:</b> {{$agendamento->abstract}}</br>
            <b>Data:</b> {{$agendamento->data_da_defesa}}</br>
            <div class="card">
                <div class="card-header">Dados do Orientador</div>
                <div class="card-body">
                    <b>Nome do Orientador:</b> {{$agendamento->nome_do_orientador}}</br>
                    <b>Número USP do orientador:</b> {{$agendamento->numero_usp_do_orientador}}</br>
                    <b>Co-Orientador?:</b> {{$agendamento->co_orientador}}</br>
                </div>
            </div>
        </div>
    </div>
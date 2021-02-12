    <div class="card">
        <div class="card-header"><b>Dados Pessoais</b></div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm">
                    <b>Nome:</b> {{$agendamento->user->name}}
                </div>
            </div>
            <br>
            @if($agendamento->divulgar_e_mail_ == 'Sim' or Auth::check())
                <div class="card">
                    <div class="card-header">E-mails</div>
                    <div class="card-body">
                        <b>E-mail USP:</b> {{$agendamento->user->email }} </br>
                        <b>Outro:</b> {{$agendamento->outro_recomendado_ }} </br>
                    </div>
                </div>
            @endif
        </div>
    </div>
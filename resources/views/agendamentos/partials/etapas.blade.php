<br>
<div class="md-stepper-horizontal">
    <div class="md-step blue @if($agendamento->status == 'Em Elaboração' or $agendamento->status != 'Em Elaboração') active @endif">
      <div class="md-step-circle"><span><i class="fas fa-play"></i></span></div>
      <div class="md-step-title">Em Elaboração</div>
      <div class="md-step-optional">Aluno</div>
      <div class="md-step-bar-left"></div>
      <div class="md-step-bar-right"></div>
    </div>
    <div class="md-step orange @if(($agendamento->data_liberacao == null and $agendamento->data_enviado_avaliacao != null) or ($agendamento->status == 'Em Avaliação' and $agendamento->data_liberacao != null) or ($agendamento->status == 'Aprovado' or $agendamento->status == 'Aprovado C/ Correções' or $agendamento->status == 'Reprovado')) active @endif">
      <div class="md-step-circle"><span><i class="fas fa-user-edit"></i></span></div>
      <div class="md-step-title">Em Avaliação</div>
      <div class="md-step-optional">Professor(a)</div>
      <div class="md-step-bar-left"></div>
      <div class="md-step-bar-right"></div>
    </div>
    <div class="md-step orange @if($agendamento->status == 'Em Avaliação' or $agendamento->status == 'Aprovado' or $agendamento->status == 'Aprovado C/ Correções' or $agendamento->status == 'Reprovado' ) active @endif">
      <div class="md-step-circle"><span><i class="fas fa-users"></i></span></div>
      <div class="md-step-title">Em Avaliação</div>
      <div class="md-step-optional">Banca</div>
      <div class="md-step-bar-left"></div>
      <div class="md-step-bar-right"></div>
    </div>
    @if(($agendamento->status == 'Aprovado' and $agendamento->data_devolucao != null) or $agendamento->status == 'Aprovado C/ Correções')
    <div class="md-step yellow @if(($agendamento->status == 'Aprovado' and $agendamento->data_enviado_correcao != '') or $agendamento->status == 'Aprovado C/ Correções') active @endif">
      <div class="md-step-circle"><span><i class="fas fa-quote-right"></i></span></div>
      <div class="md-step-title">Aprovado C/ Correções</div>
      <div class="md-step-optional">Orientador(a)</div>
      <div class="md-step-bar-left"></div>
      <div class="md-step-bar-right"></div>
    </div>
    @endif
    @if($agendamento->status == 'Aprovado')
    <div class="md-step green @if($agendamento->status == 'Aprovado') active @endif">
      <div class="md-step-circle"><span><i class="fas fa-check-square"></i></span></div>
      <div class="md-step-title">Aprovado</div>
      <div class="md-step-optional">Orientador(a)</div>
      <div class="md-step-bar-left"></div>
      <div class="md-step-bar-right"></div>
    </div>
    @endif
    @if($agendamento->status == 'Reprovado')
    <div class="md-step red @if($agendamento->status == 'Reprovado') active @endif">
      <div class="md-step-circle"><span><i class="fas fa-times"></i></span></div>
      <div class="md-step-title">Reprovado</div>
      <div class="md-step-optional">Orientador(a)</div>
      <div class="md-step-bar-left"></div>
      <div class="md-step-bar-right"></div>
    </div>
    @endif
    @if($agendamento->status != 'Reprovado')
    <div class="md-step purple @if($agendamento->publicado == 'Sim') active @endif">
      <div class="md-step-circle"><span><i class="fas fa-file-alt"></i></span></div>
      <div class="md-step-title">Publicação</div>
      <div class="md-step-optional">Biblioteca</div>
      <div class="md-step-bar-left"></div>
      <div class="md-step-bar-right"></div>
    </div>
    @endif
  </div>
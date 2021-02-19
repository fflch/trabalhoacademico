Prezado(a) {{$agendamento->user->name}},

{{$agendamento->nome_do_orientador}} enviou via sistema a avaliação do seu TGI, "{{$agendamento->titulo}}", e para a publicação é necessário reenviar o arquivo com as correções para a sua aprovação.

<h3><b>Dados do trabalho acadêmico</b></h3>
<b>Título:</b><a href="https://trabalhoacademico.fflch.usp.br/agendamentos/{{$agendamento->id}}"> {{$agendamento->titulo}}</a></br>
<b>Data da Defesa:</b> {{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') }}</br></br>
<b>Nome:</b> {{$agendamento->user->name}}
<b>E-mail USP:</b> {{$agendamento->user->email }} </br>
<b>Resultado:</b> @if($agendamento->status == 'Aprovado C/ Correções') APROVADO C/ CORREÇÕES @else REPROVADO @endif</br>

@if($agendamento->comentario)
    <b>Parecer:</b><br>
    {{$agendamento->parecer}}
@endif
<br>

Você tem 60 dias para entrar novamente no sistema e subir um novo arquivo com as alterações necessárias. Caso não faça isso, o arquivo disponibilizado para a defesa será publicado como está.

<h4><b>Sistema - Trabalhos Acadêmicos - FFLCH</b></h4>
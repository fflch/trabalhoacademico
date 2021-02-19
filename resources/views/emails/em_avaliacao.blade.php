Prezado(a) {{$agendamento->nome_do_orientador}},

{{$agendamento->user->name}} enviou via sistema o TGI "{{$agendamento->titulo}}" e para a publicação é necessário sua aprovação.

<h3><b>Dados do trabalho acadêmico</b></h3>
<b>Título:</b><a href="https://trabalhoacademico.fflch.usp.br/agendamentos/{{$agendamento->id}}"> {{$agendamento->titulo}}</a></br>
<b>Data da Defesa:</b> {{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') }}</br></br>
<b>Nome:</b> {{$agendamento->user->name}}
<b>E-mail USP:</b> {{$agendamento->user->email }} </br>

<h4><b>Sistema - Trabalhos Acadêmicos - FFLCH</b></h4>
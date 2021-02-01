Olá, professor(a) {{$agendamento->nome_do_orientador}},

Você tem um novo trabalho acadêmico para avaliar:

<h3><b>Dados do trabalho acadêmico</b></h3>
<b>Título:</b> {{$agendamento->titulo}}</br>
<b>Data:</b> {{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') }}</br></br>
<b>Nome:</b> {{$agendamento->user->name}}
<b>E-mail USP:</b> {{$agendamento->user->email }} </br>


<h4><b>Sistema - Trabalhos Acadêmicos - FFLCH</b></h4>
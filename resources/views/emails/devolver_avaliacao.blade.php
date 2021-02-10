Prezado(a) {{$agendamento->user->name}},

{{$agendamento->nome_do_orientador}} enviou via sistema a avaliação do seu TGI, "{{$agendamento->titulo}}", e para a publicação é necessário reenviar o arquivo com as correções para a sua aprovação.

<h3><b>Dados do trabalho acadêmico</b></h3>
<b>Título:</b><a href="trabalhoacademico.fflch.usp.br/agendamentos/$agendamento->id"> {{$agendamento->titulo}}</a></br>
<b>Data da Defesa:</b> {{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') }}</br></br>
<b>Nome:</b> {{$agendamento->user->name}}
<b>E-mail USP:</b> {{$agendamento->user->email }} </br>

<h4><b>Sistema - Trabalhos Acadêmicos - FFLCH</b></h4>
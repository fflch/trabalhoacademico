@inject('pessoa','Uspdev\Replicado\Pessoa')

Prezado(a) @if($professor->n_usp){{$pessoa::dump($professor->n_usp)['nompes']}}@elseif($professor->nome){{$professor->nome}}@endif,

Você foi convidado para participar da defesa de trabalho de graduação individual de {{$agendamento->user->name}}.<br>

<b>IMPORTANTE!</b> <br> 
Junto com este ofício, V. Sa está recebendo o EXEMPLAR ORIGINAL do trabalho depositado pelo(a) aluno(a) dentro do prazo regimental e que deverá servir de instrumento para as arguições feitas a(o) candidato(a) no ato da defesa.<br><br>

<h3><b>Dados do trabalho acadêmico</b></h3>
<b>Nome:</b> {{$agendamento->user->name}}
<b>Orientador:</b> {{$agendamento->nome_do_orientador}}
<b>Título:</b> {{$agendamento->titulo}}</a></br>
<b>Data da Defesa:</b> {{ Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') }}</br></br>

Atenciosamente, 
		
<h4><b>Sistema - Trabalhos Acadêmicos - FFLCH</b></h4>
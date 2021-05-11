@inject('pessoa','Uspdev\Replicado\Pessoa')

Prezado(a) {{ $pessoa::dump($professor->n_usp)['nompes'] ?? $professor->nome }},

Segue a declaração de participação da banca de defesa do trabalho acadêmico de {{ $agendamento->user->name }}.

<h4><b>Sistema - Trabalhos Acadêmicos - FFLCH</b></h4>
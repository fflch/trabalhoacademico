@inject('pessoa','Uspdev\Replicado\Pessoa')

Prezado(a) @if($professor->n_usp){{ $pessoa::dump($professor->n_usp)['nompes']}} @else {{$professor->nome }} @endif,

Segue a declaração de participação da banca de defesa do trabalho acadêmico de {{ $agendamento->user->name }}.

<h4><b>Sistema - Trabalhos Acadêmicos - FFLCH</b></h4>
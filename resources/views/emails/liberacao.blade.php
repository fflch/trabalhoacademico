@inject('pessoa','Uspdev\Replicado\Pessoa')

@if($professor->n_usp != null)
    {!! App\Models\Config::configMailLiberacao($agendamento, $agendamento->user->name, $pessoa::dump($professor->n_usp)['nompes'], $url)->mail_liberacao !!}
@elseif($professor->nome != null)
    {!! App\Models\Config::configMailLiberacao($agendamento, $agendamento->user->name, $professor->nome, $url)->mail_liberacao !!}
@endif

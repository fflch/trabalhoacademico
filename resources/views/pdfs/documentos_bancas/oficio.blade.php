@inject('pessoa','Uspdev\Replicado\Pessoa')

@extends('laravel-fflch-pdf::main')
@section('other_styles')
<style type="text/css">
    .data_hoje{
        margin-left: 10cm; margin-bottom:0.8cm; 
    }
    .conteudo{ 
        margin: 1cm 
    }
    .boxSuplente {
        border: 1px solid; padding: 4px;
    }
    .boxPassagem {
        border: 1px solid; padding: 4px; text-align: justify;
    }
    .oficioSuplente{
        text-align: justify; 
    }
    p.recuo {
        text-indent: 0.5em;
        direction: rtl;
    }
    .moremargin {
        margin-bottom: 0.15cm;
    }
    .importante {
        border:1px solid; margin-top:0.3cm; margin-bottom:0.3cm; width: 15cm; font-size:12px; margin-left:4em;
    }
    .negrito {
        font-weight: bolder;
    }
    .justificar{
        text-align: justify;
    }
    table{
        border-collapse: collapse;
        border: 0px solid #000;
    }
    table th, table td {
        border: 0px solid #000;
    }
    tr, td {
        border: 1px #000 solid; padding: 1
    }
    body{
        margin-top: 0.2em; margin-left: 1.8em; font-family: DejaVu Sans, sans-serif; font-size: 12px;
    }
</style>
@endsection('other_styles')

@section('content')

    <div align="right">
        @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
        São Paulo, {{ strftime('%d de %B de %Y', strtotime('today')) }}
    </div><br><br>

    <div class="moremargin">Assunto: Banca Examinadora de <b>Trabalho de Graduação Individual</b></div> 
    <div class="moremargin">Candidato(a): <b>{{$agendamento->user->name}}</b> </div>
    <div class="moremargin">Curso: <b>{{$agendamento->curso}}</b> </div>
    <div class="moremargin">Orientador(a) Prof(a). Dr(a). {{$agendamento->nome_do_orientador}}</div>
    <div class="moremargin">Título do Trabalho: <i>"{{$agendamento->titulo}}" </i></div><br>
    <div class="importante">
        {!! $configs->importante_oficio !!}
    </div><br>
    <p>
        <i>Data e hora da defesa:  </i> <b> {{Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y')}}, às {{Carbon\Carbon::parse($agendamento->data_da_defesa)->format('H:i')}} </b> <br> 
        <i>Local:</i> <b> {{$agendamento->sala}} </b> - Departamento de {{$agendamento->curso}} 
    </p>  
    <i>Composição da banca examinadora:</i> 


    <table width="16cm" style="border='0'; margin-left:4cm; align-items: center; justify-content: center;">
        @foreach($professores as $componente)
        <tr style="border='0'">
            <td><b>@if($componente->n_usp != null){{$pessoa::dump($componente->n_usp)['nompes'] ?? ' ' }} @elseif($componente->prof_externo_id != null) {{$componente->prof_externo->nome}} @endif</b> </td>
            <td><b>@if($componente->n_usp != null){{$pessoa::cracha($componente->n_usp)['nomorg'] ?? ' '}} @elseif($componente->prof_externo_id != null) {{$componente->prof_externo->instituicao}} @endif</b></td>
        </tr>
        @endforeach
    </table>

	<br>
    <p align="center">
        Atenciosamente, 
		<br>
        <b> 
            Secretaria do Departamento de {{$agendamento->curso}}
		</b>
    </p>
    <br><br>

    @if($professor->n_usp != null)
        Ilmo(a). Sr(a). {{$pessoa::dump($professor->n_usp)['nompes']}}<br>
        {{$pessoa::obterEndereco($professor->n_usp)['nomtiplgr'] ?? ' '}}, {{$pessoa::obterEndereco($professor->n_usp)['epflgr'] ?? ' '}}, {{$pessoa::obterEndereco($professor->n_usp)['numlgr'] ?? ' '}}, {{$pessoa::obterEndereco($professor->n_usp)['cpllgr'] ?? ' '}}, {{$pessoa::obterEndereco($professor->n_usp)['nombro'] ?? ' '}}  <br>
        CEP:{{$pessoa::obterEndereco($professor->n_usp)['codendptl'] ?? ' '}} - {{$pessoa::obterEndereco($professor->n_usp)['cidloc'] ?? ' '}}/{{$pessoa::obterEndereco($professor->n_usp)['sglest'] ?? ' '}}
        <br> telefone: @foreach($pessoa::telefones($professor->n_usp) as $telefone) {{ $telefone }} @endforeach
        <br>e-mail: @foreach($pessoa::emails($professor->n_usp) as $email) {{$email}} @endforeach
    @elseif($professor->prof_externo_id != null)
        Ilmo(a). Sr(a). {{$professor->prof_externo->nome}}<br>
        {{$professor->prof_externo->endereco ?? ' '}}, {{$professor->prof_externo->bairro ?? ' '}} - CEP:{{$professor->prof_externo->cep ?? ' '}}<br>
        {{$professor->prof_externo->cidade ?? ' '}}/{{$professor->prof_externo->estado ?? ' '}} - {{$professor->prof_externo->pais}}
        <br> telefone: {{ $professor->prof_externo->telefone }}
        <br>e-mail: {{$professor->prof_externo->email}}
    @endif
@endsection('content')

@section('footer')
    {!! $configs->configRodape($agendamento->curso)->rodape_oficios !!}
@endsection('footer')
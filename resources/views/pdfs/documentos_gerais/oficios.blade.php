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
    .rodapeFFLCH{
        padding-top:3cm; text-align: center;
    }
    p.recuo {
        text-indent: 0.5em;
        direction: rtl;
    }
    .moremargin {
        margin-bottom: 0.15cm;
    }
    .importante {
        border:1px solid; margin-top:0.3cm; margin-bottom:0.3cm; width: 15cm; font-size:12px; margin-left:0.5cm;
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
        margin-left: 1.8em; font-family: DejaVu Sans, sans-serif; font-size: 12px;
    }
    .page-break {
        page-break-after: always;
        margin-top:0px;
    }
    .page-break:last-child { page-break-after: never; }
    @page { margin-top: 120px; margin-bottom: 120px}
	header { position: fixed; left: 0px; top: -90px; right: 0px; height: 150px; text-align: center; }
	#footer { position: fixed; left: 0px; bottom: -145px; right: 0px; height: 150px; }
</style>
@endsection('other_styles')

@section('content')
    @foreach($professores as $professor)
        <p>
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
            <div>
                <i>Data e hora da defesa:  </i> <b> {{Carbon\Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y')}}, às {{Carbon\Carbon::parse($agendamento->data_da_defesa)->format('H:i')}} </b> <br> 
                <i>Local:</i> <b> {{$agendamento->sala}} </b> - Departamento de {{$agendamento->departamento}} 
            </div>  
            <i>Composição da banca examinadora:</i> 

            <table width="16cm" style="border='0'; margin-left:4cm; align-items: center; justify-content: center;">
                @foreach($bancas as $banca)    
                <tr style="border='0'">
                    <td><b>@if($banca->n_usp != null){{$pessoa::dump($banca->n_usp)['nompes'] ?? ' ' }} @elseif($banca->prof_externo_id != null) {{$banca->prof_externo->nome}} @endif</b> </td>
                    <td><b>@if($banca->n_usp != null){{$pessoa::cracha($banca->n_usp)['nomorg'] ?? ' '}} @elseif($banca->prof_externo_id != null) {{$banca->prof_externo->instituicao}} @endif</b></td>           
                </tr>
                @endforeach
            </table>

            <br>
            <div style="margin-top:2cm;" align="center"> 
                Atenciosamente, 
                <br>
                <b> 
                    Secretaria do Departamento de {{$agendamento->departamento}}
                </b>
            </div><br><br> 
            <div>
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
            </div>
        </p>
        <p class="page-break"></p> 
    @endforeach
@endsection('content')

@section('footer')
    {!! $configs->configRodape($agendamento->departamento)->rodape_oficios !!}
@endsection('footer')
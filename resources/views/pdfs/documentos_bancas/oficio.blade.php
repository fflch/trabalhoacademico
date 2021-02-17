@extends('pdfs.fflch')
@inject('pessoa','Uspdev\Replicado\Pessoa')
@inject('graduacao','Uspdev\Replicado\Graduacao')

@section('styles_head')
<style type="text/css">
    #headerFFLCH {
        font-size: 14px; width: 17cm; text-align:left; color:#273e74; margin-bottom: 0em; margin-top: 0em;   font-family: "Arial Narrow", Arial, sans-serif;;
    }
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
        text-indent: 0.5cm;
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
        margin-top: 0.2em; margin-left: 1.8em; font-family: DejaVu Sans, sans-serif; font-size: 12px;
    }
    #footer {
        position: fixed;
        bottom: -1cm;
        left: 0px;
        right: 0px;
        text-align: left;
        border-top: 1px solid gray;
        width: 18.5cm;
        height: 100px;
        color:#273e74;
        font-size: 12px;
        font-family: "Arial Narrow", Arial, sans-serif;
    }
    .page-break {
        page-break-after: always;
        margin-top:160px;
    }
</style>
@endsection('styles_head')

@section('header')
  <table style='width:100%; margin-bottom:-40px; margin-top:-80px;'>
    <tr>
      <td style='margin:0;'>
        <img src='images/logo-fflch.png' width='100px' height='45px'/>
      </td>
      <td style='margin:0;'>
        <p style="text-transform: uppercase; text-align:center; font-size:60px; margin-left:-50px; font-weight:lighter;">{{$agendamento->curso}}</p>
      </td>
      <td style='margin:0;'>
        <p style="font-size:11px; text-transform: uppercase; margin-left:10px; margin-right:-20px;">FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS
        <br>Universidade de São Paulo<br>
        Departamento de {{$agendamento->curso}}</p>
      </td>
    </tr>
  </table>
  </br>
@endsection('header')

@section('content')

    <div align="right">
        @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
        São Paulo, {{ strftime('%d de %B de %Y', strtotime('today')) }}
    </div><br><br>

    <div class="moremargin">Assunto: Banca Examinadora de <b>Trabalho de Graduação Individual</b></div> 
    <div class="moremargin">Candidato(a): <b>{{$agendamento->user->name}}</b> </div>
    <div class="moremargin">Área: <b>{{$graduacao::curso($agendamento->user->codpes,getenv('REPLICADO_CODUNDCLG'))['nomcur']}}</b> </div>
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
    <div id="footer">
        {!! $configs->rodape_oficios !!}
    </div>

@endsection('content')

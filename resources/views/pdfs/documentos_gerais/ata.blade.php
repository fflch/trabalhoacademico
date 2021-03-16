@inject('pessoa','Uspdev\Replicado\Pessoa')

@extends('pdfs.fflch')
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
    .assinatura{
		border-bottom:1px solid;
        width:100px;
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
        <p style="text-transform: uppercase; text-align:center; font-size:50px; margin-left:-50px; font-weight:lighter;">{{$agendamento->curso}}</p>
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

    <h3 align="center"> ATA DE DEFESA DE TRABALHO DE GRADUAÇÃO INDIVIDUAL </h1>
    <br><br><br>

    <p class="recuo justificar" style="line-height: 190%;">  
        @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
        Aos <b>{{ strftime('%d de %B de %Y', strtotime($agendamento->data_da_defesa)) }}</b>, na <b>{{$agendamento->sala}}</b> do Departamento de {{$agendamento->curso}} da Faculdade de Filosofia, Letras e Ciências Humanas na Universidade de São Paulo, a Banca Examinadora:         
    </p>
    <table width="16cm" style="border='0'; margin-left:4cm; align-items: center; justify-content: center;">
        @foreach($professores as $componente)    
        <tr style="border='0'">
            <td><b>@if($componente->n_usp != null){{$pessoa::dump($componente->n_usp)['nompes'] ?? ' ' }} @elseif($componente->prof_externo_id != null) {{$componente->prof_externo->nome}} @endif</b> </td>
            <td><b>@if($componente->n_usp != null){{$pessoa::cracha($componente->n_usp)['nomorg'] ?? ' '}} @elseif($componente->prof_externo_id != null) {{$componente->prof_externo->instituicao}} @endif</b></td>           
        </tr>
        @endforeach
    </table>
    <p>examinando o Trabalho de Graduação Individual em {{$agendamento->curso}}, com título:</p>
	<p style="text-align:center; font-size:16px; font-weight:bold;">"{{$agendamento->titulo}}"</p>
    
    e a defesa do aluno (a)<br><br>

    Bacharelando (a): <b>{{$agendamento->user->name}}</b><br>
    Número USP: <b>{{$agendamento->user->codpes}}</b><br>
    Curso: <b>{{$agendamento->curso}}</b><br><br>
    
    Atribuiu a nota: <b>{{$agendamento->nota}}</b>.<br><br>
    <br>
    São Paulo,{{ strftime('%d de %B de %Y', strtotime($agendamento->data_da_defesa)) }}<br><br>
    <br>
    <table width="680px" style="text-align:center; align-items:center;">
        @foreach($professores as $componente)    
        <tr>
            <td><b>@if($componente->n_usp != null){{$pessoa::dump($componente->n_usp)['nompes'] ?? ' ' }} @elseif($componente->prof_externo_id != null) {{$componente->prof_externo->nome}} @endif</b> </td>
        </tr>
        @endforeach
    </table> 
    <div id="footer">
        {!! $configs->configRodape($agendamento->curso)->rodape_oficios !!}
    </div>
@endsection('content')

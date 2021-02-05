@extends('pdfs.fflch')
@inject('pessoa','Uspdev\Replicado\Pessoa')
@inject('graduacao','Uspdev\Replicado\Graduacao')

@section('styles_head')
<style type="text/css">
    #headerFFLCH {
        font-size: 14px; width: 17cm; text-align:left; color:#273e74; margin-top: -80px; font-family: "Arial Narrow", Arial, sans-serif;;
    }
    .data_hoje{
        margin-left: 10cm; margin-bottom:0.8cm; 
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
        padding-top:3cm; text-align: center; color:#273e74;
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
        border: 1px #000 solid; padding: 1;
    }
    body{
        margin-left: 1.8em; font-family: DejaVu Sans, sans-serif; font-size: 12px;
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
    }
</style>
@endsection('styles_head')

@section('content')
    @foreach($professores as $professor)
        <table id="headerFFLCH" style='width:100%; margin-bottom:-40px;'>
            <tr>
                <td style='margin:0;'>
                    <img src='images/logo-fflch.png' width='100px' height='45px'/>
                </td>
                <td style='margin:0;'>
                    <p style="text-transform: uppercase; text-align:center; font-size:60px; margin-left:-50px; font-weight:lighter;">{{$graduacao::curso($agendamento->user->codpes,getenv('REPLICADO_CODUNDCLG'))['nomcur']}}</p>
                </td>
                <td style='margin:0;'>
                    <p style="font-size:11px; text-transform: uppercase; margin-left:10px; margin-right:-20px;">FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS
                    <br>Universidade de São Paulo<br>
                    Departamento de {{$graduacao::curso($agendamento->user->codpes,getenv('REPLICADO_CODUNDCLG'))['nomcur']}}</p>
                </td>
            </tr>
        </table>
        </br>

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
            <i>Local:</i> <b> {{$agendamento->sala}} </b> - Departamento de {{$graduacao::curso($agendamento->user->codpes,getenv('REPLICADO_CODUNDCLG'))['nomcur']}} 
        </p>  
        <i>Composição da banca examinadora:</i> 

        <table width="16cm" style="border='0'; margin-left:4cm; align-items: center; justify-content: center;">
            @foreach($bancas as $banca)    
            <tr style="border='0'">
                <td> {{$banca->nome}} </td> 
                <td><b>{{$pessoa::cracha($banca->codpes)['nomorg'] ?? ' '}}</b></td>
            </tr>
            @endforeach
        </table>

        <br>
        <p align="center">
            Atenciosamente, 
            <br>
            <b> 
                Secretaria do Departamento de {{$graduacao::curso($agendamento->user->codpes,getenv('REPLICADO_CODUNDCLG'))['nomcur']}}
            </b>
        </p><br><br> 
        Ilmo(a). Sr(a). {{$professor->nome}}<br>
        {{$pessoa::obterEndereco($professor->codpes)['nomtiplgr'] ?? ' '}}, {{$pessoa::obterEndereco($professor->codpes)['epflgr'] ?? ' '}}, {{$pessoa::obterEndereco($professor->codpes)['numlgr'] ?? ' '}}, {{$pessoa::obterEndereco($professor->codpes)['cpllgr'] ?? ' '}}, {{$pessoa::obterEndereco($professor->codpes)['nombro'] ?? ' '}}  <br>
        CEP:{{$pessoa::obterEndereco($professor->codpes)['codendptl'] ?? ' '}} - {{$pessoa::obterEndereco($professor->codpes)['cidloc'] ?? ' '}}/{{$pessoa::obterEndereco($professor->codpes)['sglest'] ?? ' '}}
        <br> telefone: @foreach($pessoa::telefones($professor->codpes) as $telefone) {{ $telefone }} @endforeach
        <br>e-mail: @foreach($pessoa::emails($professor->codpes) as $email) {{$email}} @endforeach
        <div id="footer">
            {!! $configs->rodape_oficios !!}
        </div>
        <p class="page-break">&nbsp;</p>
    @endforeach
@endsection('content')

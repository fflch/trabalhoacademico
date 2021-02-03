@inject('pessoa','Uspdev\Replicado\Pessoa')
@inject('graduacao','Uspdev\Replicado\Graduacao')

@extends('pdfs.fflch')
@section('styles_head')
<style type="text/css">
    #headerFFLCH {
        font-size: 14px; width: 17cm; text-align:center; font-weight:bold;
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
        text-align: center;
        border-top: 1px solid gray;
        width: 18.5cm;
        height: 100px;
    }
    .page-break {
        page-break-after: always;
        margin-top:100px;
    }
</style>
@endsection('styles_head')

@section('content')
    @foreach($professores as $professor)
        <table id="headerFFLCH" style='width:100%'>
            <tr>
                <td style='width:20%' style='text-align:left;'>
                    <img src='images/logo-fflch.png' width='100px'/>
                </td>
                <td style='width:80%'; style='text-align:center;'>
                    <p align='center'><b>FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS</b>
                    <br>Universidade de São Paulo<br>
                    Secretaria do Departamento de {{$graduacao::curso($agendamento->user->codpes,getenv('REPLICADO_CODUNDCLG'))['nomcur']}}</p>
                </td>
            </tr>
        </table>
        <br>

        <div align="right">
            @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
            São Paulo, {{ strftime('%d de %B de %Y', strtotime($agendamento->data_da_defesa)) }}        
        </div><br>

        <h1 align="center"> DECLARAÇÃO </h1>
        <br><br><br>

        <p class="recuo justificar" style="line-height: 190%;">
            {!! App\Models\Config::configDeclaracao($agendamento,$agendamento->nome,$professor)->declaracao !!}
        </p><br><br>

        <table width="16cm" style="border='0'; margin-left:4cm; align-items: center; justify-content: center;">
            @foreach($bancas as $banca)    
            <tr style="border='0'">
                <td><b>{{$banca->nome}}</b> </td>
                <td><b>{{$pessoa::cracha($banca->codpes)['nomorg'] ?? ' '}}</b></td>           
            </tr>
            @endforeach
        </table>
        <div style="margin-top:2cm;" align="center"> 
            Atenciosamente,<br>  
            <b>
                Secretaria do Departamento de {{$graduacao::curso($agendamento->user->codpes,getenv('REPLICADO_CODUNDCLG'))['nomcur']}} - FFLCH/USP 
            </b>
        </div> 
        <div id="footer">
            {!! $configs->rodape_oficios !!}
        </div>
        <p style="page-break-before: always">&nbsp;</p>
    @endforeach
@endsection('content')

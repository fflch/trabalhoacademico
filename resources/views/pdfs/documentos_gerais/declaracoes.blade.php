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
            São Paulo, {{ strftime('%d de %B de %Y', strtotime($agendamento->data_da_defesa)) }}        
        </div><br>

        <h1 align="center"> DECLARAÇÃO </h1>
        <br><br><br>

        <p class="recuo justificar" style="line-height: 190%; width: 100%;">
        @if($professor->n_usp)
            {!! App\Models\Config::configDeclaracao($agendamento, $agendamento->user->name, $pessoa::dump($professor->n_usp)['nompes'])->declaracao !!}
        @elseif($professor->prof_externo_id)
            {!! App\Models\Config::configDeclaracao($agendamento, $agendamento->user->name, $professor->prof_externo->nome)->declaracao !!}
        @endif
        </p><br><br>

        <table width="16cm" style="border='0'; margin-left:4cm; align-items: center; justify-content: center;">
            @foreach($bancas as $banca)    
            <tr style="border='0'">
                <td><b>@if($banca->n_usp != null){{$pessoa::dump($banca->n_usp)['nompes'] ?? ' ' }} @elseif($banca->prof_externo_id != null) {{$banca->prof_externo->nome}} @endif</b> </td>
                <td><b>@if($banca->n_usp != null){{$pessoa::cracha($banca->n_usp)['nomorg'] ?? ' '}} @elseif($banca->prof_externo_id != null) {{$banca->prof_externo->instituicao}} @endif</b></td>           
            </tr>
            @endforeach
        </table>
        <div style="margin-top:2cm;" align="center"> 
            Atenciosamente,<br>  
            <b>
                Secretaria do Departamento de {{$agendamento->curso}} - FFLCH/USP 
            </b>
        </div>
    </p>
    <p class="page-break"></p> 
    @endforeach
@endsection('content')

@section('footer')
    {!! $configs->configRodape($agendamento->curso)->rodape_oficios !!}
@endsection('footer')

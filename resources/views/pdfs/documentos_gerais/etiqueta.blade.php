@extends('pdfs.fflch')
@inject('pessoa','Uspdev\Replicado\Pessoa')

@section('styles_head')
<style type="text/css">
    body {
        margin: 1cm -1.2cm 0cm -1.2cm;
        padding:0; 
    }
    .negrito {
        font-weight: bolder;
    }
    .justificar{
        text-align: justify;
    }
    .etiqueta{
        font-size: 12px; border-spacing:0.5cm 0cm;
    }
    tr{
        margin-left:0.5cm;
    }
    td{
        margin-left:0.5cm;
    }
</style>
@endsection('styles_head')

@section('content')
    <table style="border='0'" width="19cm" class="etiqueta">
    @foreach($professores as $professor)
        <tr>
            <td width="9.85cm" height="3.33cm">
                Ilmo(a) Sr(a).<br>
                {{$professor->nome}}<br>
                {{$pessoa::obterEndereco($professor->codpes)['nomtiplgr'] ?? ' '}}, {{$pessoa::obterEndereco($professor->codpes)['epflgr'] ?? ' '}}, {{$pessoa::obterEndereco($professor->codpes)['numlgr'] ?? ' '}}, {{$pessoa::obterEndereco($professor->codpes)['cpllgr'] ?? ' '}}, {{$pessoa::obterEndereco($professor->codpes)['nombro'] ?? ' '}}  <br>
                CEP:{{$pessoa::obterEndereco($professor->codpes)['codendptl'] ?? ' '}} - {{$pessoa::obterEndereco($professor->codpes)['cidloc'] ?? ' '}}/{{$pessoa::obterEndereco($professor->codpes)['sglest'] ?? ' '}}
            </td>     
        </tr>
    @endforeach
    </table>
@endsection('content')
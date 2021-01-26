<form action="/files" enctype="multipart/form-data" method="POST">
    @csrf
    <input type="hidden" name="agendamento_id" value="{{$agendamento->id}}">
    <div class="row">
        <div class="form-group col-sm">
            <p><span style="font-size:16px; text-align:justify"><span style="color:rgb(38, 50, 56); font-family:arial,sans-serif">Com fundamento no disposto na Lei nº 9.610, de 19 de fevereiro de 1998, <strong>autorizo</strong> a Faculdade de Filosofia Letras e Ciências Humanas da Universidade de São Paulo a publicar, em ambiente digital institucional e sem ressarcimento dos direitos autorais, o texto integral da obra acima citada, em formato PDF e a título de divulgação da produção acadêmica de graduação e especialização gerada pela Faculdade.</span></span></p>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm">
            <label for="arquivo-do-trabalho"><b>Arquivo do Trabalho</b></label>
            <input type="file" class="form-control-file" id="arquivo-do-trabalho" name="file">
        </div>
        <div class="form-group col-sm">
            <label for="status" class="required"><b>Status</b></label>
            <select class="form-control" name="status">
                <option value="" selected="">- Selecione -</option>
                @foreach ($agendamento->statusOptions() as $option)
                    {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                    @if (old('status') == '' and isset($agendamento->status))
                    <option value="{{$option}}" {{ ( $agendamento->status == $option) ? 'selected' : ''}}>
                        {{$option}}
                    </option>
                    {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                    @else
                    <option value="{{$option}}" {{ ( old('status') == $option) ? 'selected' : ''}}>
                        {{$option}}
                    </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>     
    <div class="row">
        <div class="form-group col-sm">
            <button type="submit" class="btn btn-success float-right">Enviar</button> 
        </div> 
    </div>
</form>

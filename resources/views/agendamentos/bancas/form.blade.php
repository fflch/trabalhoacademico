@inject('pessoa','Uspdev\Replicado\Pessoa')

<div class="form-group row">
    <div class="col-sm form-group">
        <label for="codpes" class="required">Número USP </label> 
        <input type="text" name="codpes" class="form-control" value="{{ old('codpes', $banca->codpes) }}"> 
    </div>
    <div class="col-sm form-group">
        <label for="presidente" class="required">Presidente</label>
        <select class="form-control" name="presidente">
            <option value="" selected="">- Selecione -</option>
            @foreach ($banca->presidenteOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('presidente') == '' and isset($banca->presidente))
                <option value="{{$option}}" {{ ( $banca->presidente == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option}}" {{ ( old('presidente') == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="col-sm form-group">
        <label for="tipo" class="required">Tipo</label>
        <select class="form-control" name="tipo">
            <option value="" selected="">- Selecione -</option>
            @foreach ($banca->tipoOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('tipo') == '' and isset($banca->tipo))
                <option value="{{$option}}" {{ ( $banca->tipo == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option}}" {{ ( old('tipo') == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                @endif
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success float-right">Enviar</button> 
</div> 

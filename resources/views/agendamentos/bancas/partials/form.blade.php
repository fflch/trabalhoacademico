<form action="/bancas" method="POST">
    @csrf
    <input type="hidden" name="agendamento_id" value="{{$agendamento->id}}">
    <div class="row form-group">
        <div class="col-sm">
            <label for="n_usp">Docente USP </label> 
            <select class="form-control" name="n_usp">
                <option value="" selected="">- Selecione -</option>
                @foreach ($agendamento->docentes() as $option)
                    <option value="{{$option['codpes']}}" {{ ( old('n_usp') == $option['codpes']) ? 'selected' : ''}}>
                        {{$option['nompes']}}
                    </option>
                @endforeach
            </select>        
        </div>
        <div class="col-auto"><br><br>ou</div>
        <div class="col-sm">
            <label for="prof_externo_id">Docente Externo</label> 
            <select class="form-control" name="prof_externo_id">
                <option value="" selected="">- Selecione -</option>
                @foreach ($agendamento->profExterno() as $option)
                    <option value="{{$option['id']}}" {{ ( old('prof_externo_id') == $option['id']) ? 'selected' : ''}}>
                        {{$option['nome']}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" style="margin-top:1.98em" class="btn btn-success float-right">Inserir Membro</button> 
        </div>
    </div>
</form>
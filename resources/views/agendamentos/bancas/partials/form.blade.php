<form action="/bancas" method="POST">
    @csrf
    <input type="hidden" name="agendamento_id" value="{{$agendamento->id}}">
    <div class="row">
        <div class="col-sm form-group">
            <label for="codpes" class="required">Número USP </label> 
            <input type="text" name="codpes" class="form-control"> 
        </div>
        <div class="col-sm form-group">
            <label for="nome" class="required">Nome Docente </label> 
            <input type="text" name="nome" class="form-control"> 
        </div>
        <div class="col-sm form-group">
            <label for="presidente" class="required">Presidente</label>
            <select class="form-control" name="presidente">
                <option value="" selected="">- Selecione -</option>
                @foreach ($agendamento->presidenteOptions() as $option)
                    <option value="{{$option}}" {{ ( old('presidente') == $option) ? 'selected' : ''}}>
                        {{$option}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm">
            <button type="submit" class="btn btn-success float-right">Inserir Membro</button> 
        </div>
    </div> 
</form>
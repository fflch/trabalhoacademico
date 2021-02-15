<form action="/bancas" method="POST">
    @csrf
    <input type="hidden" name="agendamento_id" value="{{$agendamento->id}}">
    <div class="row">
        <div class="col-sm form-group">
            <label for="codpes">Número USP </label> 
            <input type="text" name="codpes" class="form-control"> 
        </div>
        <div class="col-sm form-group">
            <label for="nome">Nome Docente </label> 
            <input type="text" name="nome" class="form-control"> 
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm">
            <button type="submit" class="btn btn-success float-right">Inserir Membro</button> 
        </div>
    </div> 
</form>
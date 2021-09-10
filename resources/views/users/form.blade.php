<div class="row form-group">
    <div class="col-sm">
        <label for="codpes"><b>Número USP</b></label> 
        <input type="text" class="form-control" name="codpes" value="{{ old('codpes', $user->codpes) }}">
    </div>
</div>

<div class="form-group row">
    <div class="col-sm">
        <label for="name"><b>Nome</b></label>  
        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
    </div>
</div>

<div class="form-group row">
    <div class="col-sm">
        <label for="email"><b>Email</b></label> 
        <input class="form-control" type="text" name="email" value="{{ old('email', $user->email) }}">
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success float-right">Enviar</button> 
</div> 
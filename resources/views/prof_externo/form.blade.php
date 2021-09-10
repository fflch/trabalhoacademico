<div class="row form-group">
    <div class="col-sm">
        <label for="nome"><b>Nome Completo</b></label> 
        <input type="text" class="form-control" name="nome" value="{{ old('nome', $profExterno->nome) }}">
    </div>
</div>

<div class="form-group row">
    <div class="col-sm">
        <label for="cpf"><b>CPF</b></label> 
        <input class="form-control" type="text" name="cpf" value="{{ old('cpf', $profExterno->cpf) }}">
    </div>
    <div class="col-sm">
        <label for="rg"><b>RG</b></label>  
        <input type="text" class="form-control" name="rg" value="{{ old('documento', $profExterno->documento) }}">
    </div>
</div>

<div class="form-group row">
    <div class="col-sm">
        <label for="endereco"><b>Endereço</b></label> 
        <input type="text"  class="form-control" name="endereco" value="{{ old('endereco', $profExterno->endereco) }}">
    </div>
    <div class="col-sm">
        <label for="bairro"><b>Bairro</b></label> 
        <input type="text" class="form-control" name="bairro" value="{{ old('bairro', $profExterno->bairro) }}">
    </div>
    <div class="col-sm">
        <label for="cep"><b>CEP</b></label> 
        <input type="text" class="form-control" name="cep" value="{{ old('cep', $profExterno->cep) }}">
    </div>
</div>
 
<div class="form-group row">
    <div class="col-sm">
        <label for="cidade"><b>Cidade</b></label>  
        <input type="text" class="form-control" name="cidade" value="{{ old('cidade', $profExterno->cidade) }}">
    </div>
    <div class="col-sm">
        <label for="estado"><b>Estado</b></label> 
        <input type="text" class="form-control" name="estado" value="{{ old('estado', $profExterno->estado) }}">  
    </div>
    <div class="col-sm">
        <label for="pais"><b>País</b></label>
        <input type="text" class="form-control" name="pais" value="{{ old('Brasil', $profExterno->pais) }}">  
    </div>
</div>

<div class="form-group row">
    <div class="col-sm">
        <label for="telefone"><b>Telefone</b></label> 
        <input type="text" class="form-control" name="telefone" value="{{ old('telefone', $profExterno->telefone) }}">  
    </div>
    <div class="col-sm">
        <label for="email"><b>E-mail</b></label> 
        <input type="text" class="form-control" name="email" value="{{ old('email', $profExterno->email) }}">  
    </div>
</div>

<div class="form-group row">
    <div class="col-sm">
        <label for="instituicao"><b>Nome e sigla da Universidade na qual tem vínculo profissional</b></label> 
        <input type="text"  class="form-control" name="instituicao" value="{{ old('instituicao', $profExterno->instituicao) }}">
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success float-right">Enviar</button> 
</div> 
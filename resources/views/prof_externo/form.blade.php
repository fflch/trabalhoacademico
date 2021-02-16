<div class="form-group row">
    <div class="form-group col-sm">
        <label for="nome">Nome Completo </label> 
        <input type="text" class="form-control" name="nome" value="{{ old('nome', $profExterno->nome) }}">
    </div>
</div>

<div class="form-group row">
    <div class="form-group col-sm">
        <label for="cpf">CPF</label> 
        <input class="form-control" type="text" name="cpf" value="{{ old('cpf', $profExterno->cpf) }}">
    </div>
    <div class="form-group col-sm">
        <label for="rg"> RG </label>  
        <input type="text" class="form-control" name="rg" value="{{ old('documento', $profExterno->documento) }}">
    </div>
</div>

<div class="form-group row">
    <div class="form-group col-sm">
        <label for="endereco"> Endereço </label> 
        <input type="text"  class="form-control" name="endereco" value="{{ old('endereco', $profExterno->endereco) }}">
    </div>
    <div class="form-group col-sm">
        <label for="bairro"> Bairro</label> 
        <input type="text" class="form-control" name="bairro" value="{{ old('bairro', $profExterno->bairro) }}">
    </div>
    <div class="form-group col-sm">
        <label for="cep">CEP </label> 
        <input type="text" class="form-control" name="cep" value="{{ old('cep', $profExterno->cep) }}">
    </div>
</div>
 
<div class="form-group row">
    <div class="form-group col-sm">
        <label for="cidade">Cidade </label>  
        <input type="text" class="form-control" name="cidade" value="{{ old('cidade', $profExterno->cidade) }}">
    </div>
    <div class="form-group col-sm">
        <label for="estado">Estado</label> 
        <input type="text" class="form-control" name="estado" value="{{ old('estado', $profExterno->estado) }}">  
    </div>
    <div class="form-group col-sm">
        <label for="pais">País</label>
        <input type="text" class="form-control" name="pais" value="{{ old('Brasil', $profExterno->pais) }}">  
    </div>
</div>

<div class="form-group row">
    <div class="form-group col-sm">
        <label for="telefone">Telefone </label> 
        <input type="text" class="form-control" name="telefone" value="{{ old('telefone', $profExterno->telefone) }}">  
    </div>
    <div class="form-group col-sm">
        <label for="email">E-mail </label> 
        <input type="text" class="form-control" name="email" value="{{ old('email', $profExterno->email) }}">  
    </div>
</div>

<div class="form-group row">
    <div class="form-group col-sm">
        <label for="instituicao"> Nome e sigla da Universidade na qual tem vínculo profissional </label> 
        <input type="text"  class="form-control" name="instituicao" value="{{ old('instituicao', $profExterno->instituicao) }}">
    </div>
</div>
<button type="submit" class="btn btn-success">Enviar</button>
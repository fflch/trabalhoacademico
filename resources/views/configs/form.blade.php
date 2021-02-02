<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="sitename">Nome do sistema</label>
		<input type="text" class="form-control" name="sitename" value="{{$config->sitename}}">
	</div>
	<div class="form-group col-sm">
		<label class="config" for="rodape_site">Rodapé do sistema</label> 
		<input type="text" class="form-control" name="rodape_site" value="{{$config->rodape_site}}">
	</div>
</div>
	
<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="rodape_oficios">Rodapé (ofício titular, suplente e declaração)</label>  
		<textarea rows="10" class="form-control" cols="70" name="rodape_oficios">{{$config->rodape_oficios}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="importante_oficio">Mensagem Importante no Ofício dos titulares</label>  
		<textarea rows="10" class="form-control" cols="70" name="importante_oficio">{{$config->importante_oficio}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="regimento">Regimento - Artigo no Ofício dos titulares</label>  
		<textarea rows="10" class="form-control" cols="70" name="regimento">{{$config->regimento}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="oficio_suplente">Ofício Suplente </label>  
		<textarea rows="10" class="form-control" cols="70" name="oficio_suplente">{{$config->oficio_suplente}}</textarea> 
		<span class="badge badge-warning">Token de substituição: %data_oficio_suplente, %nome_sala, %predio </span> 
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="declaracao">Declaração de participação</label>  
		<textarea rows="10" class="form-control" cols="70" name="declaracao">{{$config->declaracao}}</textarea>
		<span class="badge badge-warning">Token de substituição: %docente_nome, %nivel, %candidato_nome, %titulo, %area, %orientador </span> 
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="mail_docente"> E-mails para docente </label>  
		<textarea rows="10" cols="70" class="form-control" name="mail_docente">{{$config->mail_docente}}</textarea> 
		<span class="badge badge-warning">Token de substituição: %docente_nome, %candidato_nome, %data_defesa, %local_defesa </span>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="mail_aluno"> E-mails para aluno </label>  
		<textarea rows="10" cols="70" class="form-control" name="mail_aluno">{{$config->mail_aluno}}</textarea> 
		<span class="badge badge-warning">Token de substituição: %docente_nome, %candidato_nome, %data_defesa, %local_defesa </span>
	</div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success float-right">Salvar</button> 
</div> 

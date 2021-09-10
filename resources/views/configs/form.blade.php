<div class="form-group row">
	<div class="col-sm">
		<label class="config" for="sitename"><b>Nome do sistema</b></label>
		<input type="text" class="form-control" name="sitename" value="{{$config->sitename}}">
	</div>
	<div class="col-sm">
		<label class="config" for="rodape_site"><b>Rodapé do sistema</b></label> 
		<input type="text" class="form-control" name="rodape_site" value="{{$config->rodape_site}}">
	</div>
</div>
	
<div class="form-group row">
	<div class="col-sm">
		<label class="config" for="rodape_oficios"><b>Rodapé (ofício titular, suplente e declaração)</b></label>  
		<textarea rows="10" class="form-control" cols="70" name="rodape_oficios">{{$config->rodape_oficios}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="col-sm">
		<label class="config" for="importante_oficio"><b>Mensagem Importante no Ofício dos titulares</b></label>  
		<textarea rows="10" class="form-control" cols="70" name="importante_oficio">{{$config->importante_oficio}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="col-sm">
		<label class="config" for="declaracao"><b>Declaração de participação</b></label>  
		<textarea rows="10" class="form-control" cols="70" name="declaracao">{{$config->declaracao}}</textarea>
		<span class="badge badge-warning">Token de substituição: %docente_nome, %nivel, %candidato_nome, %titulo, %area, %orientador </span> 
	</div>
</div>

<div class="form-group row">
	<div class="col-sm">
		<label class="config" for="mail_avaliacao"><b>Mensagem de E-mail para Docente (quando aluno envia para avaliação)</b></label>  
		<textarea rows="10" cols="70" class="form-control" name="mail_avaliacao">{{$config->mail_avaliacao}}</textarea> 
		<span class="badge badge-warning">Token de substituição: %docente_nome, %candidato_nome, %titulo, %agendamento_id, %data_defesa, %agendamento_email </span>
	</div>
</div>

<div class="form-group row">
	<div class="col-sm">
		<label class="config" for="mail_liberacao"><b>Mensagem de E-mail para Banca (quando docente libera a defesa para avaliação da banca)</b></label>  
		<textarea rows="10" cols="70" class="form-control" name="mail_liberacao">{{$config->mail_liberacao}}</textarea> 
		<span class="badge badge-warning">Token de substituição: %docente_nome,%candidato_nome, %orientador, %titulo, %data_defesa </span>
	</div>
</div>

<div class="form-group row">
	<div class="col-sm">
		<label class="config" for="mail_devolucao"><b>Mensagem de E-mail para Aluno (quando aluno é aprovado com correções a serem feitas)</b></label>  
		<textarea rows="10" cols="70" class="form-control" name="mail_devolucao">{{$config->mail_devolucao}}</textarea> 
		<span class="badge badge-warning">Token de substituição: %candidato_nome, %orientador, %titulo, %agendamento_id, %data_defesa, %status, %parecer </span>
	</div>
</div>

<div class="form-group row">
	<div class="col-sm">
		<label class="config" for="mail_aprovacao"><b>Mensagem de E-mail para Aluno (quando aluno é aprovado)</b></label>  
		<textarea rows="10" cols="70" class="form-control" name="mail_aprovacao">{{$config->mail_aprovacao}}</textarea> 
		<span class="badge badge-warning">Token de substituição: %candidato_nome, %orientador, %titulo, %agendamento_id, %data_defesa, %status, %parecer </span>
	</div>
</div>

<div class="form-group row">
	<div class="col-sm">
		<label class="config" for="mail_correcao"><b>Mensagem de E-mail para Professor (quando aluno envia trabalho corrigido)</b></label>  
		<textarea rows="10" cols="70" class="form-control" name="mail_correcao">{{$config->mail_correcao}}</textarea> 
		<span class="badge badge-warning">Token de substituição: %docente_nome, %candidato_nome, %titulo, %agendamento_id, %data_defesa, %agendamento_email </span>
	</div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success float-right">Salvar</button> 
</div> 

<form action="/files" enctype="multipart/form-data" method="POST">
    @csrf
    <input type="hidden" name="agendamento_id" value="{{$agendamento->id}}">
    <input type="hidden" name="tipo" value="trabalho">
    <div class="row">
        <div class="col-sm">
            <p><span style="font-size:16px; text-align:justify; color:rgb(38, 50, 56); font-family:arial,sans-serif">Com fundamento no disposto na Lei nº 9.610, de 19 de fevereiro de 1998, <strong>autorizo</strong> a Faculdade de Filosofia Letras e Ciências Humanas da Universidade de São Paulo a publicar, em ambiente digital institucional e sem ressarcimento dos direitos autorais, o texto integral da obra acima citada, em formato PDF e a título de divulgação da produção acadêmica de graduação e especialização gerada pela Faculdade.</span></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <label for="arquivo-do-trabalho" class="required"><b>Arquivo do Trabalho</b></label>
            <input type="file" class="form-control-file" id="arquivo-do-trabalho" name="file">
            <span class="badge badge-warning"><b>Atenção:</b> Os arquivos a serem enviados devem ter no máximo 12mb.</span><br>
        </div>
        <div class="col-auto">
            <button type="submit" style="margin-top:2.98em" class="btn btn-success float-right">Enviar</button> 
        </div>
        <input type="hidden" name="status" value="{{$agendamento->status}}">
    </div>     
</form>

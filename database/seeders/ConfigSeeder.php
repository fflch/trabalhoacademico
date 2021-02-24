<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = [
            'sitename' => 'Trabalhos Acadêmicos',
            'rodape_site' => 'FFLCH',
            'rodape_oficios' => '<p style="text-transform: uppercase; margin:0 auto;">SECRETARIA DO DEPARTAMENTO DE %departamento</p><br>
            %endereco<br> 
            Tel: (11) 3091-4612 | www.fflch.usp.br',
            'importante_oficio' => '<center> <b>IMPORTANTE!</b> <br> Junto com este ofício, V. Sa está recebendo o EXEMPLAR ORIGINAL do trabalho depositado pelo(a) aluno(a) dentro do prazo regimental e que deverá servir de instrumento para as arguições feitas a(o) candidato(a) no ato da defesa.</center>. ',
            'declaracao' => 'Declaro, para os devidos fins, que o(a) Prof(a). Dr(a). <b>%docente_nome</b> participou, nesta data, da defesa do Trabalho de Graduação Individual do(a) Sr(a) %candidato_nome, intitulado: "%titulo", na área de %area, sob a presidência do(a) Prof.(a) Dr.(a) %orientador, integrando a Comissão Julgadora, formada pelos Professores Doutores:',
            'mail_avaliacao' => 'Prezado(a) %docente_nome,

            %candidato_nome enviou via sistema o TGI "%titulo", é necessário sua liberação para a avaliação da banca.
            
            <h3><b>Dados do trabalho acadêmico</b></h3>
            <b>Título:</b><a href="trabalhoacademico.fflch.usp.br/agendamentos/%agendamento_id"> %titulo</a></br>
            <b>Data da Defesa:</b> %data_defesa</br></br>
            <b>Nome:</b> %candidato_nome<br><br>
            <b>E-mail USP:</b> %agendamento_email </br>
            
            <h4><b>Sistema - Trabalhos Acadêmicos - FFLCH</b></h4>',
            'mail_liberacao' => 'Prezado(a) %docente_nome,

            Você foi convidado para participar da banca de defesa do trabalho acadêmico de %candidato_nome.
            
            <h3><b>Dados do trabalho acadêmico</b></h3>
            <b>Título:</b><a href="trabalhoacademico.fflch.usp.br/agendamentos/%agendamento_id"> %titulo</a></br>
            <b>Data da Defesa:</b> %data_defesa</br></br>
            <b>Nome:</b> %candidato_nome<br><br>
            
            <b>IMPORTANTE!</b> <br> 
            Junto com este e-mail, V. Sa está recebendo o EXEMPLAR ORIGINAL do trabalho depositado pelo(a) aluno(a) dentro do prazo regimental e que deverá servir de instrumento para as arguições feitas a(o) candidato(a) no ato da defesa. <br><br>
            
            <h4><b>Sistema - Trabalhos Acadêmicos - FFLCH</b></h4>',
            'mail_devolucao' => 'Prezado(a) %candidato_nome

            %orientador enviou via sistema a avaliação do seu TGI, "%titulo", e para a publicação é necessário reenviar o arquivo com as correções para a sua aprovação.
            
            <h3><b>Dados do trabalho acadêmico</b></h3>
            <b>Título:</b><a href="trabalhoacademico.fflch.usp.br/agendamentos/%agendamento_id"> %titulo</a></br>
            <b>Data da Defesa:</b> %data_defesa</br></br>
            <b>Nome:</b> %candidato_nome<br><br>
            
            <b>Resultado:</b> %status</br>
            
            <b>Parecer:</b> %parecer<br><br>
            
            <b>Importante</b><br>
            Lembre-se que você tem até 60 dias para acessar o sistema e fazer o upload da versão corrigida de seu trabalho.<br><br>
            
            <h4><b>Sistema - Trabalhos Acadêmicos - FFLCH</b></h4>',
            'mail_aprovacao' => 'Prezado(a) %candidato_nome,

            %orientador enviou via sistema o resultado da defesa do seu TGI, "%titulo".
            
            <h3><b>Dados do trabalho acadêmico</b></h3>
            <b>Título:</b><a href="trabalhoacademico.fflch.usp.br/agendamentos/%agendamento_id"> %titulo</a></br>
            <b>Data da Defesa:</b> %data_defesa</br></br>
            <b>Nome:</b> %candidato_nome<br><br>
            
            <b>Resultado:</b> %status</br>
            
            <b>Parecer:</b> %parecer<br><br>
            
            <h4><b>Sistema - Trabalhos Acadêmicos - FFLCH</b></h4>',
            
        ];
        Config::create($config);
    }
}

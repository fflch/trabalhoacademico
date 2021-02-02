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
            'sitename' => 'Defesas',
            'rodape_site' => 'FFLCH',
            'rodape_oficios' => 'Serviço de Pós-Graduação <br> defesaspos.fflch@usp.br / 3091-4626 <br>
            Prédio da Administração da FFLCH-USP <br>
            Rua do Lago 717, sala 118 - CEP 05508-080',
            'importante_oficio' => '<center> <b>IMPORTANTE!</b> <br> Junto com este ofício, V. Sa está recebendo o EXEMPLAR ORIGINAL do trabalho depositado pelo(a) aluno(a) dentro do prazo regimental e que deverá servir de instrumento para as arguições feitas a(o) candidato(a) no ato da defesa.</center>. ',
            'regimento' => '<center>  <b> Artigo 97 do Regimento de Pós-Graduação da USP </b> <br>	O julgamento da dissertação de mestrado e da tese de doutorado será realizado de acordo com critérios previamente estabelecidos pela respectiva CPG. <br> § 1º - A arguição, após exposição de no máximo 30 minutos realizada pelo candidato, ocorrerá em sessão pública, e não deverá exceder o prazo de três horas para o mestrado, cinco horas para o doutorado (antigo regimento) e quatro horas para alunos do novo regimento (banca com 3 examinadores). </center></b>',
            'oficio_suplente' => '<p> Venho, pelo presente, informar que seu nome foi aprovado pela Comissão de Pós-Graduação para, na qualidade de </b>membro suplente</b>, integrar a banca examinadora do(a) aluno(a) supracitado(a).</p> 
            <p> A defesa está prevista para o dia <b>%data_oficio_suplente</b>, no(a) %nome_sala do Prédio da %predio.</p> 
            <p>Na impossibilidade do comparecimento de um dos membros titulares, V. Sa. será convidado(a) a integrar a referida banca, motivo pelo qual, segue anexo a versão PDF do trabalho.',
            'declaracao' => 'Declaro, para os devidos fins, que o(a) Prof(a). Dr(a). <b>%docente_nome</b> participou, nesta data, da defesa do trabalho de %nivel do(a) Sr(a) %candidato_nome, intitulado: "%titulo", na área %area, sob a presidência do(a) Prof.(a) Dr.(a) %orientador, integrando a Comissão Julgadora, formada pelos Professores Doutores:',
            'mail_docente' => '<hr>
            <p> <b> e-mail para dados de passagem </b> </p> <br>
            <p>Prezado(a) Prof.(a) Dr.(a): %docente_nome, </p><br>
            <p>Solicito a gentileza de nos responder, o mais breve possível, às consultas abaixo, visando sua participação como membro da Comissão Julgadora abaixo explicitada: </p>
            <br>
            <p>Candidato: <b> %candidato_nome </b></p>
            <p>Data da defesa: %data_defesa <p>
            <p>Local: %local_defesa <p>
            <br>
            
            <p><b><u><font size=3>
            1. Tipo de participação:</u></b>
            <br>
            <br>
            <p><font size=3><b>
            [   ] Presencial 
            </font></p></b>
            <br>
            <p><font size=3><b>
            [   ] Por videoconferência
            </font></p></b>
            <br>
            <br>
            <p><b><u><font size=3> 2.  Qual será seu meio de Transporte: </font></u></b> 
            <br>
            <br>
            <p><font size=3>[   ]<b>  Carro </b>–   não há reembolso de combustível</font></p>
            <br>
            <p><font size=3>[   ]<b>  Ônibus </b>–  há reembolso de passagens após a defesa, mediante apresentação dos bilhetes</font></p>
            <br>
            <p><font size=3>[   ]<b>  Aéreo (*)</b> – passagem comprada pelo Serviço de Pós-Graduação</font></p> <p><b>
            <br>
            <br>
            <p><b><u><font size=3> 3.  Qual será o itinerário? - só em caso de passagem aérea </font></u></b> 
            <br>
            <br>
            <p><b><font size=3> Ida:</font></b>_________________________________/São Paulo (Capital)</p>
            <p><b><font size=3> Data:</font></b> _______/_______</p>
            <p><b><font size=3> Horário aproximado:</font></b> _______:_______ <i>(poderá haver uma variação para mais ou para menos de até 2 horas)</i></p>
            <br>
            <p><b><font size=3> Volta:</font></b>São Paulo (Capital)/_________________________________</p>
            <p><b><font size=3> Data:</font></b> _______/_______</p>
            <p><b><font size=3> Horário aproximado:</font></b> _______:_______ <i>(poderá haver uma variação para mais ou para menos de até 2 horas)</i></p>
            <br>
            <p style="color:red;"><i><b> Depois de compradas as passagens, qualquer multa decorrente de alterações de datas e horários de viagem será de responsabilidade do próprio passageiro.</i></b></p>
            <br>
            <p><b><u><font size=3> 4.  Hospedagem </font></u></b></p>
            <br>
            <p><b><font size=3>[    ]   Não preciso de hospedagem</b></p>
            <br>
            <p><b><font size=3>[    ]   A reserva será feita por mim, em Hotel de minha preferência
            <br>
            <br>
            <p><b><font size=3>[    ]   No Hotel  conveniado</b> (reserva feita pelo Serviço de Pós)</p>
            <p><i>Hotel WZ Jardins<. Av. Rebouças, 955 - Cerqueira César</i></p>
            <br>
            <p><u><b>Favor informar: </u></b></p>
            <p>Data do check in: _______/_______    Data do check out: ____/_____</p> Horário aproximado da chegada: _____ horas
            <br>
            <br>
            <br>
            <p>Desde já agradeço seu retorno.</p>
            <br>
            <hr>
            <p><b>e-mail para seguir com a reserva de hotel: </b></p>
            <br>
            <p>Prezado(a) Prof.(a) Dr.(a): %docente_nome, </p>
            <br>
            <p>Segue sua pré-reserva no <b><u>Hotel Wz Jardins</b></u>. Esta pré-reserva ficará garantida somente até às <b>18h</b> do dia do check in. Após esse horário será cancelada. </p>
            <br>
            <p>Para garantir sua reserva, caso precise entrar após às 18h, favor entrar em contato com o hotel (reservas@wzhoteljardins.com.br) para depósito bancário ou para fornecer dados de cartão de crédito e confirmar sua reserva.</p>
            <br>
            <p>O pagamento do pernoite será efetuado pelos próprios hóspedes. O ressarcimento dessa despesa será feito por meio de pagamento de uma diária via depósito bancário. O valor da diária CAPES é de R$ 320,00.</p>
            <br>
            <p>O depósito bancário da diária será feito em até 10 dias úteis após a defesa.</p>
            <br>
            <p>Qualquer dúvida entre em contato.</p>
            <br>
            <hr>
            <p><b>e-mail para atualização e confirmação de dados cadastrais  de professor externo: </b></p>
            <br>
            <p>Prezado(a) Prof.(a) Dr.(a): %docente_nome, </p>
            <br>
            <p>Tendo em vista sua indicação como membro titular de banca de desta faculdade, peço-lhe, por favor, que confirme os dados abaixo para envio da dissertação / tese: </p>
            <br>
            <p>Endereço: </p>
            <p>Telefones (residencial e celular): </p>
            <br>
            <p>Desde já lhe agradeço e aguardo o retorno.</p>
            <hr>
            <p> <b> e-mail para enviar convite e dissertação/tese em PDF </b> </p> <br>
            <p>Prezados Professores, </p>
            <br>
            <p>Segue, em anexo, o convite oficial e a dissertação/tese na versão em PDF do(a) aluno(a) <b>%candidato_nome</b>.</p>
            <br>
            <p>A defesa está agendada para <b> %data_defesa. </b></p>
            <br>
            <br>
            <p>
            </p>
            <br>
            <br>
            <hr>
            <hr>
            <p> <b> e-mail para enviar Instruções do USE Táxi </b> </p> <br>
            <p>Prezado(a) Prof.(a) Dr.(a): %docente_nome, </p>
            <br>
            <p>Segue em anexo as instruções relativas aos procedimentos de reembolso de despesas com táxi e almoço para os professores externos à USP participantes das bancas de mestrado e doutorado da FFLCH-USP.</p>
            <br>
            <p>Número de Celular cadastrado no sistema de táxi: %docente_nome</p>
            <br>
            <br>
            <hr>
            <hr>
            <p> <b> e-mail para enviar dissertação/tese em PDF para suplente</b> </p> <br>
            <br>
            <br>
            <p>Prezados Professores, </p>
            <br>
            <p>Tendo em vista sua indicação dentre os <b>MEMBROS SUPLENTES</u></b> da Banca Examinadora do(a) aluno(a) <b>%candidato_nome</b>, envio-lhe em anexo, a versão em PDF da dissertação/tese.
            </p>
            <br>
            <p>Na impossibilidade do comparecimento de um dos membros titulares, V. Sa. será convidado(a) a integrar a referida banca.
            </p>
            <br>
            <p>A defesa está agendada para <b> %data_defesa </b>.</p>
            <br>
            <br>',
            'mail_aluno' => '<hr>
            <p> <b> e-mail para dados de passagem </b> </p> <br>
            <p>Prezado(a) Prof.(a) Dr.(a): %docente_nome, </p><br>
            <p>Solicito a gentileza de nos responder, o mais breve possível, às consultas abaixo, visando sua participação como membro da Comissão Julgadora abaixo explicitada: </p>
            <br>
            <p>Candidato: <b> %candidato_nome </b></p>
            <p>Data da defesa: %data_defesa <p>
            <p>Local: %local_defesa <p>
            <br>
            
            <p><b><u><font size=3>
            1. Tipo de participação:</u></b>
            <br>
            <br>
            <p><font size=3><b>
            [   ] Presencial 
            </font></p></b>
            <br>
            <p><font size=3><b>
            [   ] Por videoconferência
            </font></p></b>
            <br>
            <br>
            <p><b><u><font size=3> 2.  Qual será seu meio de Transporte: </font></u></b> 
            <br>
            <br>
            <p><font size=3>[   ]<b>  Carro </b>–   não há reembolso de combustível</font></p>
            <br>
            <p><font size=3>[   ]<b>  Ônibus </b>–  há reembolso de passagens após a defesa, mediante apresentação dos bilhetes</font></p>
            <br>
            <p><font size=3>[   ]<b>  Aéreo (*)</b> – passagem comprada pelo Serviço de Pós-Graduação</font></p> <p><b>
            <br>
            <br>
            <p><b><u><font size=3> 3.  Qual será o itinerário? - só em caso de passagem aérea </font></u></b> 
            <br>
            <br>
            <p><b><font size=3> Ida:</font></b>_________________________________/São Paulo (Capital)</p>
            <p><b><font size=3> Data:</font></b> _______/_______</p>
            <p><b><font size=3> Horário aproximado:</font></b> _______:_______ <i>(poderá haver uma variação para mais ou para menos de até 2 horas)</i></p>
            <br>
            <p><b><font size=3> Volta:</font></b>São Paulo (Capital)/_________________________________</p>
            <p><b><font size=3> Data:</font></b> _______/_______</p>
            <p><b><font size=3> Horário aproximado:</font></b> _______:_______ <i>(poderá haver uma variação para mais ou para menos de até 2 horas)</i></p>
            <br>
            <p style="color:red;"><i><b> Depois de compradas as passagens, qualquer multa decorrente de alterações de datas e horários de viagem será de responsabilidade do próprio passageiro.</i></b></p>
            <br>
            <p><b><u><font size=3> 4.  Hospedagem </font></u></b></p>
            <br>
            <p><b><font size=3>[    ]   Não preciso de hospedagem</b></p>
            <br>
            <p><b><font size=3>[    ]   A reserva será feita por mim, em Hotel de minha preferência
            <br>
            <br>
            <p><b><font size=3>[    ]   No Hotel  conveniado</b> (reserva feita pelo Serviço de Pós)</p>
            <p><i>Hotel WZ Jardins<. Av. Rebouças, 955 - Cerqueira César</i></p>
            <br>
            <p><u><b>Favor informar: </u></b></p>
            <p>Data do check in: _______/_______    Data do check out: ____/_____</p> Horário aproximado da chegada: _____ horas
            <br>
            <br>
            <br>
            <p>Desde já agradeço seu retorno.</p>
            <br>
            <hr>
            <p><b>e-mail para seguir com a reserva de hotel: </b></p>
            <br>
            <p>Prezado(a) Prof.(a) Dr.(a): %docente_nome, </p>
            <br>
            <p>Segue sua pré-reserva no <b><u>Hotel Wz Jardins</b></u>. Esta pré-reserva ficará garantida somente até às <b>18h</b> do dia do check in. Após esse horário será cancelada. </p>
            <br>
            <p>Para garantir sua reserva, caso precise entrar após às 18h, favor entrar em contato com o hotel (reservas@wzhoteljardins.com.br) para depósito bancário ou para fornecer dados de cartão de crédito e confirmar sua reserva.</p>
            <br>
            <p>O pagamento do pernoite será efetuado pelos próprios hóspedes. O ressarcimento dessa despesa será feito por meio de pagamento de uma diária via depósito bancário. O valor da diária CAPES é de R$ 320,00.</p>
            <br>
            <p>O depósito bancário da diária será feito em até 10 dias úteis após a defesa.</p>
            <br>
            <p>Qualquer dúvida entre em contato.</p>
            <br>
            <hr>
            <p><b>e-mail para atualização e confirmação de dados cadastrais  de professor externo: </b></p>
            <br>
            <p>Prezado(a) Prof.(a) Dr.(a): %docente_nome, </p>
            <br>
            <p>Tendo em vista sua indicação como membro titular de banca de desta faculdade, peço-lhe, por favor, que confirme os dados abaixo para envio da dissertação / tese: </p>
            <br>
            <p>Endereço: </p>
            <p>Telefones (residencial e celular): </p>
            <br>
            <p>Desde já lhe agradeço e aguardo o retorno.</p>
            <hr>
            <p> <b> e-mail para enviar convite e dissertação/tese em PDF </b> </p> <br>
            <p>Prezados Professores, </p>
            <br>
            <p>Segue, em anexo, o convite oficial e a dissertação/tese na versão em PDF do(a) aluno(a) <b>%candidato_nome</b>.</p>
            <br>
            <p>A defesa está agendada para <b> %data_defesa. </b></p>
            <br>
            <br>
            <p>
            </p>
            <br>
            <br>
            <hr>
            <hr>
            <p> <b> e-mail para enviar Instruções do USE Táxi </b> </p> <br>
            <p>Prezado(a) Prof.(a) Dr.(a): %docente_nome, </p>
            <br>
            <p>Segue em anexo as instruções relativas aos procedimentos de reembolso de despesas com táxi e almoço para os professores externos à USP participantes das bancas de mestrado e doutorado da FFLCH-USP.</p>
            <br>
            <p>Número de Celular cadastrado no sistema de táxi: %docente_nome</p>
            <br>
            <br>
            <hr>
            <hr>
            <p> <b> e-mail para enviar dissertação/tese em PDF para suplente</b> </p> <br>
            <br>
            <br>
            <p>Prezados Professores, </p>
            <br>
            <p>Tendo em vista sua indicação dentre os <b>MEMBROS SUPLENTES</u></b> da Banca Examinadora do(a) aluno(a) <b>%candidato_nome</b>, envio-lhe em anexo, a versão em PDF da dissertação/tese.
            </p>
            <br>
            <p>Na impossibilidade do comparecimento de um dos membros titulares, V. Sa. será convidado(a) a integrar a referida banca.
            </p>
            <br>
            <p>A defesa está agendada para <b> %data_defesa </b>.</p>
            <br>
            <br>',
            
        ];
        Config::create($config);
    }
}

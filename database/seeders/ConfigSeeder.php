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
            'rodape_oficios' => 'SECRETARIA DO DEPARTAMENTO DE GEOGRAFIA<br>
            Av. Prof. Lineu Prestes, 338 | Edifício Eurípedes Simões de Paula | Cidade Universitária | São Paulo-SP | CEP 05508-000<br> 
            Tel: (11) 3091-3769 | www.fflch.usp.br',
            'importante_oficio' => '<center> <b>IMPORTANTE!</b> <br> Junto com este ofício, V. Sa está recebendo o EXEMPLAR ORIGINAL do trabalho depositado pelo(a) aluno(a) dentro do prazo regimental e que deverá servir de instrumento para as arguições feitas a(o) candidato(a) no ato da defesa.</center>. ',
            'declaracao' => 'Declaro, para os devidos fins, que o(a) Prof(a). Dr(a). <b>%docente_nome</b> participou, nesta data, da defesa do Trabalho de Graduação Individual do(a) Sr(a) %candidato_nome, intitulado: "%titulo", na área de %area, sob a presidência do(a) Prof.(a) Dr.(a) %orientador, integrando a Comissão Julgadora, formada pelos Professores Doutores:',
            'mail_avaliacao' => '',
            'mail_liberacao' => '',
            'mail_devolucao' => '',
            'mail_aprovacao' => '',
            
        ];
        Config::create($config);
    }
}

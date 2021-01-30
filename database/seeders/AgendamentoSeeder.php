<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Uspdev\Replicado\Pessoa;
use App\Models\Agendamento;
use App\Models\Banca;
use Carbon\Carbon;

class AgendamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agendamento1 = [
            'user_id' => 1,                                   
            'outro_recomendado_' => '',        
            'divulgar_e_mail_' => 'Sim',
            'titulo' => 'Trabalho e academia',                    
            'resumo' => 'Mais um trabalhoooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo',
            'palavras_chave' => 'trabalho, academia, universidade',            
            'abstract' => '',                  
            'data_da_defesa' => '25/02/2021',           
            'nome_do_orientador' => 'Dário Horácio Gutierrez Gallardo',           
            'numero_usp_do_orientador' => 65389,              
            'status' => 'Em Elaboração',                    
        ];
        Agendamento::create($agendamento1);
        
        Agendamento::factory(5)->create()->each(function ($agendamento) {           
            $bancas = Banca::factory(4)->make();
            $agendamento->bancas()->saveMany($bancas);
        });
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Uspdev\Replicado\Pessoa;
use App\Models\Agendamento;
use App\Models\Banca;

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
            'codpes' => 5166999,                   
            'nome' => 'Breno Aparecido Servidone Moreno', 
            'e_mail_usp' => Pessoa::emailusp(5166999),                
            'outro_recomendado_' => '',        
            'divulgar_e_mail_' => 'Sim',
            'titulo' => 'Trabalho e academia',                    
            'resumo' => 'Mais um trabalhoooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo',
            'palavras_chave' => 'trabalho, academia, universidade',            
            'abstract' => '',                  
            'data_da_defesa' => '2021-01-25 12:00:00',          
            'nome_orientador' => 'Dário Horácio Gutierrez Gallardo',           
            'numero_usp_do_orientador' => 65389,              
            'co_orientador' => 'Não',             
            'status' => 'Em avaliação',                    
        ];
        Agendamento::create($agendamento1);
        
        Agendamento::factory(20)->create()->each(function ($agendamento) {           
            $bancas = Banca::factory(4)->make();
            $agendamento->bancas()->saveMany($bancas);
        });
    }
}

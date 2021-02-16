<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banca;

class BancaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $professor0 = [
            'n_usp' => 65389,
            'prof_externo_id' => null,
            'presidente' => 'Sim',
            'agendamento_id' => 1,
        ];

        $professor1 = [
            'n_usp' => 214972,
            'prof_externo_id' => null,
            'presidente' => 'Não',
            'agendamento_id' => 1,
        ];

        $professor2 = [
            'n_usp' => 5751095,
            'prof_externo_id' => null,
            'presidente' => 'Não',
            'agendamento_id' => 1,
        ];

        $professor3 = [
            'n_usp' => 8718763,
            'prof_externo_id' => null,
            'presidente' => 'Não',
            'agendamento_id' => 1,
        ];
        Banca::create($professor0);
        Banca::create($professor1);
        Banca::create($professor2);
        Banca::create($professor3);
    }
}

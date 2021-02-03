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
            'codpes' => 65389,
            'nome' => 'Dário Horácio Gutierrez Gallardo',
            'presidente' => 'Sim',
            'agendamento_id' => 1,
        ];

        $professor1 = [
            'codpes' => 214972,
            'nome' => 'André Mota',
            'presidente' => 'Não',
            'agendamento_id' => 1,
        ];

        $professor2 = [
            'codpes' => 5751095,
            'nome' => 'Eduardo Silveira Netto Nunes',
            'presidente' => 'Não',
            'agendamento_id' => 1,
        ];

        $professor3 = [
            'codpes' => 8718763,
            'nome' => 'Silvia Maria Fávero Arend',
            'presidente' => 'Não',
            'agendamento_id' => 1,
        ];
        Banca::create($professor0);
        Banca::create($professor1);
        Banca::create($professor2);
        Banca::create($professor3);
    }
}

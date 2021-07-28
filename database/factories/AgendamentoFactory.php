<?php

namespace Database\Factories;

use App\Models\Agendamento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Uspdev\Replicado\Pessoa;
use Uspdev\Replicado\Graduacao;
use App\Models\User;
use App\Utils\ReplicadoUtils;

class AgendamentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agendamento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $divulga = Agendamento::divulgaOptions();
        $aluno = User::factory(1)->create()->toArray();
        $orientador = $this->faker->docente();
        return [
            'user_id' => $aluno[0]['id'],
            'outro_recomendado_' => '',
            'divulgar_e_mail_' => $divulga[array_rand($divulga)],
            'titulo' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'resumo' => $this->faker->text($maxNbChars = 200), 
            'tipo' => 'Virtual', 
            'palavras_chave' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'abstract' => $this->faker->text($maxNbChars = 200),
            'data_da_defesa' => $this->faker->dateTime($max = 'now', $timezone = 'UTC')->format('d/m/Y H:i'),
            'sala' => 'Sala Virtual',
            'nome_do_orientador' => Pessoa::dump($orientador)['nompes'],
            'numero_usp_do_orientador' => $orientador,
            'status' => 'Em Elaboração',
            'curso' => ReplicadoUtils::curso($aluno[0]['codpes'])[0]['nomcur'],
            'publicado' => 'Não',
        ];
    }
}

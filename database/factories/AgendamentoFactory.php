<?php

namespace Database\Factories;

use App\Models\Agendamento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Uspdev\Replicado\Pessoa;

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
        $co_orientador = ['Sim', 'Não'];
        $status = ['Em elaboração', 'Em Avaliação', 'Aprovado']; 
        $aluno = $this->faker->unique()->graduacao();
        $orientador = $this->faker->docente();
        return [
            'codpes' => $aluno,
            'nome' => Pessoa::dump($aluno)['nompes'],
            'e_mail_usp' => Pessoa::emailusp($aluno),
            'outro_recomendado_' => '',
            'divulgar_e_mail_' => $divulga[array_rand($divulga)],
            'titulo' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'resumo' => $this->faker->text($maxNbChars = 200), 
            'palavras_chave' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'abstract' => $this->faker->text($maxNbChars = 200),
            'data_da_defesa' => $this->faker->dateTime($max = 'now', $timezone = 'UTC')->format('d/m/Y'),
            'nome_do_orientador' => Pessoa::dump($orientador)['nompes'],
            'numero_usp_do_orientador' => $orientador,
            'co_orientador' => $co_orientador[array_rand($co_orientador)],
            'status' => $status[array_rand($status)],
        ];
    }
}

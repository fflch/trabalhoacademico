<?php

namespace Database\Factories;

use App\Models\ProfExterno;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfExternoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProfExterno::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'cpf' => $this->faker->unique()->cpf(),
            'rg' => $this->faker->unique()->rg(), // Preenche a coluna 'documento' (input 'rg' do form)
            'instituicao' => 'Universidade de São Paulo - USP',
            'endereco' => $this->faker->streetAddress(),
            'bairro' => 'Butantã',
            'cep' => '05508-000',
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            'pais' => 'Brasil',
            'email' => $this->faker->unique()->safeEmail(),
            'telefone' => '(11) 99999-9999',
        ];
    }
}

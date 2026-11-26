<?php

namespace Tests\Browser;

use App\Models\ProfExterno;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProfExternoCrudTest extends DuskTestCase
{
    use DatabaseTruncation;

    public function test_create_professor_externo(): void
    {
        $cpf = fake('pt_BR')->cpf();
        $rg = fake('pt_BR')->rg();

        $this->browse(function (Browser $browser) use ($cpf, $rg) {
            $this->loginSenhaUnica($browser);

            $browser->clickLink('Professor Externo')
                ->clickLink('Cadastrar Professor Externo')
                ->waitForText('Cadastrar')
                ->type('nome', 'João Silva Externo')
                ->type('cpf', $cpf)
                ->type('rg', $rg)
                ->type('endereco', 'Av. Professor Lineu Prestes, 123')
                ->type('bairro', 'Butantã')
                ->type('cep', '05508-000')
                ->type('cidade', 'São Paulo')
                ->type('estado', 'SP')
                ->type('pais', 'Brasil')
                ->type('telefone', '(11) 99999-9999')
                ->type('email', 'joao.externo@usp.br')
                ->type('instituicao', 'Universidade Estadual de Campinas - UNICAMP')
                ->press('Enviar')
                ->waitForText('João Silva Externo');
        });

        $this->assertDatabaseHas('prof_externos', [
            'nome'  => 'João Silva Externo',
            'cpf'   => preg_replace('/\D/', '', $cpf),
            'email' => 'joao.externo@usp.br',
        ]);
    }

    public function test_edit_professor_externo(): void
    {
        $prof = ProfExterno::factory()->create();

        $this->browse(function (Browser $browser) use ($prof) {
            $this->loginSenhaUnica($browser);

            $browser->visit("/prof_externo/{$prof->id}/edit")
                ->waitForText('Editar - Docente')
                ->type('nome', 'Nome Editado Pelo Dusk')
                ->type('email', 'email.editado@usp.br')
                ->press('Enviar')
                ->waitForText('Nome Editado Pelo Dusk');
        });

        $this->assertDatabaseHas('prof_externos', [
            'id'    => $prof->id,
            'nome'  => 'Nome Editado Pelo Dusk',
            'email' => 'email.editado@usp.br',
        ]);
    }

    public function test_delete_professor_externo(): void
    {
        $prof = ProfExterno::factory()->create();

        $this->browse(function (Browser $browser) use ($prof) {
            $this->loginSenhaUnica($browser);

            $browser->visit("/prof_externo/{$prof->id}/edit")
                ->waitForText('Editar - Docente')
                ->press('Apagar')
                ->acceptDialog()
                ->waitForLocation('/prof_externo')
                ->assertDontSee($prof->nome);
        });

        $this->assertDatabaseMissing('prof_externos', [
            'id' => $prof->id,
        ]);
    }
}
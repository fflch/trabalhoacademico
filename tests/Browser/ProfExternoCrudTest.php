<?php

namespace Tests\Browser;

use App\Models\ProfExterno;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProfExternoCrudTest extends DuskTestCase
{
    /**
     * 1. Testa a criação de um novo Docente Externo
     */
    public function test_pode_cadastrar_um_docente_externo()
    {
        $this->browse(function (Browser $browser) {
            $cpf = fake('pt_BR')->cpf();

            $browser->visit('/')
                ->clicklink('Entrar')
                ->assertSee('Senhaunica-faker')
                ->type('loginUsuario', 111111)
                ->press('Login')
                ->waitForText('Sair');

            $browser->clicklink('Professor Externo')
                ->clicklink('Cadastrar Professor Externo')
                ->type('nome', 'João Silva Externo')
                ->type('cpf', $cpf) // Use um CPF fictício gerado se houver validação real
                ->type('rg', $cpf)
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
                ->assertSee('João Silva Externo'); 
        });
    }

    /**
     * 2. Testa a edição de um Docente Externo
     */
    public function test_pode_editar_um_docente_externo()
    {
        // Cria um registro no banco antes
        $prof = ProfExterno::factory()->create();

        $this->browse(function (Browser $browser) use ($prof) {
            $browser->visit('/prof_externo/' . $prof->id . '/edit')
                    ->waitForText('Editar - Docente')
                    
                    // Altera apenas alguns campos para simular uma edição real
                    ->type('nome', 'Nome Editado Pelo Dusk')
                    ->type('email', 'email.editado@usp.br')
                    
                    // Dica: Se o erro do CPF unique ainda não estiver arrumado no backend, 
                    // você pode burlar no teste alterando o CPF aqui:
                    // ->type('cpf', '000.111.222-33')
                    
                    ->press('Enviar')
                    ->assertSee('Nome Editado Pelo Dusk');
        });
    }

    /**
     * 3. Testa a exclusão do Docente Externo a partir da tela de edição
     */
    public function test_pode_apagar_um_docente_externo()
    {
        $prof = ProfExterno::factory()->create();

        $this->browse(function (Browser $browser) use ($prof) {
            $browser->visit('/prof_externo/' . $prof->id . '/edit')
                    ->press('Apagar') 
                    ->acceptDialog() // Confirma o alert JavaScript: "Você tem certeza que deseja apagar?"
                    ->assertPathIs('/prof_externo'); 
        });
    }
}
<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseTruncation;

    public function test_user_login_and_logout_via_senhaunica(): void
    {
        
        $this->browse(function (Browser $browser) {
            $this->logoutSenhaUnica($browser);

            $browser->visit('/')
                ->clickLink('Entrar')
                ->waitForText('Senhaunica-faker')
                ->type('loginUsuario', '111111')
                ->press('Login')
                ->waitForText('Sair')
                ->assertSee('Sair');

            $this->assertDatabaseHas('users', [
                'codpes' => 111111,
            ]);

            // Encerra a sessão para não interferir nos testes seguintes
            $browser->clickLink('Sair')
                ->waitForText('Entrar')
                ->assertSee('Entrar');
        });
    }
}

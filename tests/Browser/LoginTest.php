<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_login(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clicklink('Entrar')
                ->type('#loginUsuario', 111111)
                ->press('Login')
                ->waitForText('Sair')
                ->assertSee('Sair');
        });
    }
}

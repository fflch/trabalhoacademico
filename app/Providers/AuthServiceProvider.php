<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Uspdev\Replicado\Graduacao;
use Uspdev\Replicado\Pessoa;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::define('LOGADO', function ($user) {
            return $user;
        });

        Gate::define('ALUNOGR', function ($user) {
            if(Pessoa::cracha($user->codpes)['tipvinaux'] == 'ALUNOGR'){
                return true;
            }
            return false;
        });

        Gate::define('DOCENTE', function ($user) {
            if(Pessoa::cracha($user->codpes)['tipvinaux'] == 'DOCENTE'){
                return true;
            }
            return false;
        });

        Gate::define('SERVIDOR', function ($user) {
            if(Pessoa::cracha($user->codpes)['tipvinaux'] == 'SERVIDOR'){
                return true;
            }
            return false;
        });
    }
}

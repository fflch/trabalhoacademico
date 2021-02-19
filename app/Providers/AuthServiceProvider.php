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

        Gate::define('ADMIN', function ($user) {
            $admins = explode(',', trim(env('ADMINS')));
            return in_array($user->codpes, $admins);
        });
        
        Gate::define('LOGADO', function ($user) {
            return true;
        });

        Gate::define('OWNER', function ($user, $model) {
            if(Gate::allows('ADMIN')) return true;
            if($model->user_id == $user->id) return true;
            return false;
        });

        Gate::define('DOCENTE', function ($user, $agendamento = null) {
            if(Gate::allows('ADMIN')) return true;
            $is_docente = in_array('Docente',Pessoa::vinculosSetores($user->codpes,8));
            if($is_docente && $agendamento == null) return true;
            if($is_docente && $agendamento->numero_usp_do_orientador == $user->codpes) return true;
            return false;
        });

        Gate::define('ALUNO', function ($user) {
            if(Gate::allows('ADMIN')) return true;
            $is_aluno = in_array('Aluno de Graduação',Pessoa::vinculosSetores($user->codpes,8));
            if($is_aluno) return true;
            return false;
        });

    }
}

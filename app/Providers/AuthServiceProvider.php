<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Uspdev\Replicado\Graduacao;
use Uspdev\Replicado\Pessoa;
use App\Models\File;
use App\Policies\FilePolicy;
use App\Utils\ReplicadoUtils;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         File::class => FilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::define('admin', function ($user) {
            $admins = explode(',', trim(env('SENHAUNICA_ADMINS')));
            return in_array($user->codpes, $admins);
        });

        Gate::define('logado', function ($user) {
            if(Gate::allows('admin')) return true;
            return true;
        });

        Gate::define('owner', function ($user, $model) {
            if(Gate::allows('admin')) return true;
            if($model->user_id == $user->id) return true;
            return false;
        });

        Gate::define('docente', function ($user, $agendamento = null) {
            if(Gate::allows('admin')) return true;
            $is_docente = ReplicadoUtils::isDocente($user->codpes);
            if($is_docente && $agendamento == null) return true;
            if($is_docente && $agendamento->numero_usp_do_orientador == $user->codpes) return true;
            return false;
        });

        Gate::define('aluno', function ($user) {
            if(Gate::allows('admin')) return true;
            $is_aluno = in_array('Aluno de Graduação',Pessoa::vinculosSetores($user->codpes,8));
            if($is_aluno) return true;
            return false;
        });

        Gate::define('biblioteca', function ($user) {
            if(Gate::allows('admin')) return true;
            $biblioteca = explode(',', trim(env('CODPES_BIBLIOTECA')));
            return in_array($user->codpes, $biblioteca);
        });
    }
}

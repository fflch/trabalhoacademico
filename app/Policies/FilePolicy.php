<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class FilePolicy
{
    use HandlesAuthorization;

    public $is_superAdmin;
    
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->is_superAdmin = Gate::allows('ADMIN');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return mixed
     */
    public function view(User $user, File $file)
    {
        if($file->agendamento->publicado == 'Sim'){
            return true;
        }
        elseif($user->id == $file->agendamento->user_id or $user->codpes == $file->agendamento->numero_usp_do_orientador or $this->is_superAdmin){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return mixed
     */
    public function update(User $user, File $file)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return mixed
     */
    public function delete(User $user, File $file)
    {
        # O arquivo só pode ser apagado nas condições:
        # pelo owner
        # nos status: em elaboração e aprovado com correção
        $status = ["Em Elaboração","Aprovado C/ Correções"];
        if(in_array($file->agendamento->status,$status) && ($file->agendamento->user_id == $user->id or $this->is_superAdmin)){
           return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return mixed
     */
    public function restore(User $user, File $file)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return mixed
     */
    public function forceDelete(User $user, File $file)
    {
        //
    }
}

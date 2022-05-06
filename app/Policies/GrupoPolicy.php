<?php

namespace App\Policies;

use App\Models\Grupo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GrupoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grupo  $grupo
     * @return mixed
     */
    public function view(User $user, Grupo $grupo)
    {
        foreach ($user->personale->inscripciones as $inscripcione) {
            if ($inscripcione->grupo->id == $grupo->id) {
                return true;
            }
        }
        abort(404);
        //return false;
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
     * @param  \App\Models\Grupo  $grupo
     * @return mixed
     */
    public function update(User $user, Grupo $grupo)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grupo  $grupo
     * @return mixed
     */
    public function delete(User $user, Grupo $grupo)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grupo  $grupo
     * @return mixed
     */
    public function restore(User $user, Grupo $grupo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grupo  $grupo
     * @return mixed
     */
    public function forceDelete(User $user, Grupo $grupo)
    {
        //
    }
}

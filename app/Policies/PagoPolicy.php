<?php

namespace App\Policies;

use App\Models\Pago;
use App\Models\Obligacione;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagoPolicy
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
     * @param  \App\Models\Pago  $pago
     * @return mixed
     */
    public function view(User $user, Pago $pago)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pago  $pago
     * @return mixed
     */
    public function update(User $user, Pago $pago)
    {
        $obligacione = $pago->obligacione;

        if ($user->personal->id == $obligacione->inscripcione->personal_id) {
            return true;
        } else {
            
            $roles =  $user->roles->pluck('name', 'id')->toArray();
            $clave = array_search('Admin', $roles);    
            if ($clave == false) {
                $clave = array_search('Asistente', $roles);    
            }

            if($clave != false ){
                return true;
            }
        }

        

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pago  $pago
     * @return mixed
     */
    public function delete(User $user, Pago $pago)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pago  $pago
     * @return mixed
     */
    public function restore(User $user, Pago $pago)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pago  $pago
     * @return mixed
     */
    public function forceDelete(User $user, Pago $pago)
    {
        //
    }
}

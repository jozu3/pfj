<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Contacto;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function crear(User $user){
        return true;
    }


    public function updating(User $user, Contacto $contacto){
        
    }


}

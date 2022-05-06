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
     
    public function __construct()
    {
        //
    }*/

    public function crear(User $user){
        return true;
    }

    public function vendiendo(User $user, Contacto $contacto){

        //return true;
        //$contacto = Contacto::find($id)

        if ($user->personal->id == $contacto->personal_id) {
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

    public function updating(User $user, Contacto $contacto){
        
        /*if ($user->id == $contacto->personal_id || $user->hasRole(['Admin', 'Asistente'])) {
            return true;
        } else {
            return false;
        }*/

    }


}

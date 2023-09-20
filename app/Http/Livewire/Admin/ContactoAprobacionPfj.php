<?php

namespace App\Http\Livewire\Admin;

use App\Models\Contacto;
use App\Models\User;
use App\Notifications\NewConsejeroObispoNotification;
use Livewire\Component;

class ContactoAprobacionPfj extends Component
{
    public $contacto_id;

    protected $listeners = ['aprobacionPfj'];

    public function aprobacionPfj(){

        $contacto = Contacto::find($this->contacto_id);
        $obispo = User::whereHas('personale', function($q) use ($contacto){
                        $q->whereHas('contacto', function($q) use ($contacto){
                            $q->where('barrio_id', $contacto->barrio_id);
                        });
                    })->whereHas('roles', function($q){
                        $q->where('slug', 'obispo');
                    })->first();
                    
        if ($contacto->estado == 1) {
            if($obispo){
                $update = $contacto->update([
                    'estado' => 2
                ]);
                
                if ($update) {
                    $obispo->notify(new NewConsejeroObispoNotification($contacto));
                    
                    return redirect()->route('admin.contactos.show', $this->contacto_id)->with('info', 'Se aprobó y envió al obispo.');
                }
            } else {
                $this->emit('no_hay_obispo');
            }

        }
    }

    public function render()
    {
        return view('livewire.admin.contacto-aprobacion-pfj');
    }
}

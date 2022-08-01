<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Companerismo extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    
    public function grupo(){
    	return $this->belongsTo(Grupo::class);
    }
    public function role(){
    	return $this->belongsTo(Role::class);
    }

    public function inscripcioneCompanerismos()   {
        return $this->hasMany(InscripcioneCompanerismo::class);
    }

    public function participanteCompanias(){
        return $this->hasMany(ParticipanteCompania::class);
    }

    public function participantes(){
        $participantes = Participante::whereHas('participanteCompania', function($q){
            $q->where('companerismo_id', $this->id);
        })->get();
        return $participantes;
    }
}

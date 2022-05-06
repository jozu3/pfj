<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InscripcioneCompanerismo;
use App\Models\Seguimiento;
use App\Models\Programa;
use App\Models\Contacto;
use App\Models\User;
use App\Models\Inscripcione;

class Personale extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function seguimientos(){
        return $this->hasMany(Seguimiento::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function inscripciones(){
        return $this->hasMany(Inscripcione::class);
    }

    public function contacto(){
    	return $this->belongsTo(Contacto::class);
    }
    
    public function barrio(){
    	return $this->belongsTo(Barrio::class);
    }
    
    public function inscripcioneCompanerismos(){
    	return $this->hasMany(InscripcioneCompanerismo::class);
    }
    
    public function rolPrograma(Programa $programa){
        return Inscripcione::where('programa_id', $programa->id)->where('personale_id', $this->id)->first()->role;
    }

    public function companerismoPrograma(Programa $programa){
        $inscripcioneCompanerismo = InscripcioneCompanerismo::where('personale_id', $this->id)->whereHas('companerismo', function($q) use ($programa){
            $q->whereHas('grupo', function($qu) use ($programa){
                $qu->where('programa_id', $programa->id);
            });
        })->first();

        if($inscripcioneCompanerismo != null){
            return $inscripcioneCompanerismo->companerismo;
        }
    }

    public function inscripcionePrograma(Programa $programa){
        $inscripcione = Inscripcione::where('personale_id', $this->id)->where('programa_id', $programa->id)->first();
        return $inscripcione;
    }

}

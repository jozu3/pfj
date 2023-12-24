<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ConsejoCoordinacione;

class Estaca extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function consejoCoordinacione(){
    	return $this->belongsTo(ConsejoCoordinacione::class);
    }

    public function barrios(){
        return $this->hasMany(Barrio::class);
    }

    public function participantes(){
        $participantes = Participante::whereHas('barrio', function($q){
            $q->where('estaca_id', $this->id);
        })->get();
        return $participantes;
    }

    public function estacaInscripciones(){
        return $this->hasMany(EstacaInscripcione::class);
    }
}

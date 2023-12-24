<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function barrio(){
    	return $this->belongsTo(Barrio::class);
    }
    
    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }

    public function estadoAprobacione()
    {
        return $this->belongsTo(EstadoAprobacione::class, 'estado_aprobacion', 'id');
    }

    public function participanteCompania(){
        return $this->hasOne(ParticipanteCompania::class);
    }

    public function alojamiento(){
    	return $this->hasOne(Alojamiento::class);
    }
}
/*

Estado de participante	
0	inscrito
1	ingresado
2	permutado
3	terminado
4	retirado
'5' => 'En espera', 
'6' => 'Canceló inscripción'

*/
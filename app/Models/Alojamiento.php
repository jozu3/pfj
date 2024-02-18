<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alojamiento extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function participante()
    {
        return $this->belongsTo(Participante::class);
    }

    public function habitacione()
    {
        return $this->belongsTo(Habitacione::class);
    }

    public function compania(){
        return $this->participante->participanteCompania->companerismo;
    }

}

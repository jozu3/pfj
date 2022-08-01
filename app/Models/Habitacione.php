<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacione extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function piso(){
    	return $this->belongsTo(Piso::class);
    }

    public function alojamientos(){
    	return $this->hasMany(Alojamiento::class);
    }

    public function alojamientosPersonales(){
    	return $this->hasMany(AlojamientoPersonale::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function edificio(){
    	return $this->belongsTo(Edificio::class);
    }

    public function habitaciones(){
        return $this->hasMany(Habitacione::class);
    }
}

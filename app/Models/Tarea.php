<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function tareaMateriales(){
        return $this->hasMany(TareaMateriale::class);
    }

    public function programa(){
        return $this->belongsTo(Programa::class);
    }

    public function inscripcioneTareas(){
    	return $this->hasMany(InscripcioneTarea::class);
    }    

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
    
}

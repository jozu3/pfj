<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function programa(){
        return $this->belongsTo(Programa::class);
    }

    public function inscripcioneTareas(){
    	return $this->hasMany(InscripcioneTarea::class);
    }
}

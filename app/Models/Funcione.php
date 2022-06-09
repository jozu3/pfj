<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Programa;
use App\Models\FuncioneInscripcione;

class Funcione extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function programa(){
        return $this->belongsTo(Programa::class);
    }

    public function funcioneInscripciones() {
        return $this->hasMany(FuncioneInscripcione::class);
    }    
}

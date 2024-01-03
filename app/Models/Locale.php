<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function edificios(){
        return $this->hasMany(Edificio::class);
    }

    public function programas(){
        return $this->hasMany(Programa::class);
    }
    
}

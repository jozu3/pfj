<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Programa;

class Grupo extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function programa(){
    	return $this->belongsTo(Programa::class);
    }


    public function capacitaciones(){
        return $this->hasMany(Capacitacione::class);
    } 

    public function companerismos(){
        return $this->hasMany(Companerismo::class);
    } 

}

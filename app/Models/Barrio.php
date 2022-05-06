<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function estaca(){
    	return $this->belongsTo(Estaca::class);
    }

    public function personaless(){
        return $this->hasMany(Personales::class);
    }


}

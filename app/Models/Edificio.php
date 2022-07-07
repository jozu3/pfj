<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function locale(){
    	return $this->belongsTo(Locale::class);
    }

    public function pisos(){
        return $this->hasMany(Piso::class);
    }
}

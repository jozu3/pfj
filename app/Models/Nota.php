<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personale_nota;

class Nota extends Model
{
    use HasFactory;
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function unidad(){
    	return $this->belongsTo(Unidad::class);
    }

    public function personaleNota(){
    	return $this->hasMany(Personale_nota::class);
    }
}

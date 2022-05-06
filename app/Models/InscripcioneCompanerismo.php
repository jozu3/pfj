<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscripcione;

class InscripcioneCompanerismo extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function companerismo(){
    	return $this->belongsTo(Companerismo::class);
    }
    
    public function inscripcione(){
    	return $this->belongsTo(Inscripcione::class);
    }

   
}

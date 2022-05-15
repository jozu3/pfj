<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personale;
use App\Models\Vacuna;

class PersonaleVacuna extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function personale(){
    	return $this->belongsTo(Personale::class);
    }

    public function vacuna(){
        return $this->belongsTo(Vacuna::class);
    }
}

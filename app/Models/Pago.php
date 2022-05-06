<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Obligacione;
use App\Models\Cuenta;
use App\Models\Personale;

class Pago extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function obligacione(){
    	return $this->belongsTo(Obligacione::class);
    }

    public function cuenta(){
    	return $this->belongsTo(Cuenta::class);
    }

    public function personal(){
    	return $this->belongsTo(Personale::class);
    }
}

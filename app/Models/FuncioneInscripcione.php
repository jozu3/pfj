<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscripcione;
use App\Models\Funcione;

class FuncioneInscripcione extends Model
{
    use HasFactory;

    public function inscripcione(){
        return $this->belongsTo(Inscripcione::class);
    }

    public function funcione(){
        return $this->belongsTo(Funcione::class);
    }
}

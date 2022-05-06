<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscripcione;
use App\Models\Capacitacione;

class Asistencia extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function inscripcione(){
        return $this->belongsTo(Inscripcione::class);
    }

    public function capacitacione(){
        return $this->belongsTo(Capacitacione::class);
    }
}
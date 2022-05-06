<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscripcioneTarea extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function tarea(){
        return $this->belongsTo(Tarea::class);
    }

    public function inscripcione(){
        return $this->belongsTo(Inscripcione::class);
    }
}

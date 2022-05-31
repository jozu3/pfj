<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaMateriale extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function tarea(){
        return $this->belongsTo(Tarea::class);
    }

    public function materiale(){
        return $this->belongsTo(Materiale::class);
    }
}

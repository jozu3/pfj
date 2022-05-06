<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacione extends Model
{
    use HasFactory;
 
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function inscripcione(){
        return $this->belongsTo(Inscripcione::class);
    }

    public function actividade(){
        return $this->belongsTo(Actividade::class);
    }
}

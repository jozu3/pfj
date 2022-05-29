<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcione extends Model
{
    use HasFactory;

    public function personales() {
        return $this->belongsToMany(Funcione::class);
    }
}

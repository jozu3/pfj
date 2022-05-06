<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estaca extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function consejoCoodinacione(){
    	return $this->belongsTo(consejoCoodinacione::class);
    }

    public function barrios(){
        return $this->hasMany(Barrio::class);
    }

}

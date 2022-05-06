<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seguimiento;
use App\Models\Personale;

class Contacto extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function seguimientos(){
        return $this->hasMany(Seguimiento::class);
    }

    public function personale(){
        return $this->hasOne(Personale::class);
    }
    
    public function personal(){
        return $this->belongsTo(Personale::class);
    }

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

}

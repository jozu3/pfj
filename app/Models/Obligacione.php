<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscripcione;
use App\Models\Pago;

class Obligacione extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function inscripcione(){
    	return $this->belongsTo(Inscripcione::class);
    }

    public function pagos(){
    	return $this->hasMany(Pago::class);
    }
}

/*
@switch ($obligacione->estado)
    @case(0)
        Exonerado
        @break
    @case(1)
        Por pagar
        @break
    @case(2)
        Parcial
        @break
    @case(3)
        Pagado
        @break
@endswitch
*/

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipanteCompania extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function participante()
    {
        return $this->belongsTo(Participante::class);
    }

    public function companerismo()
    {
        return $this->belongsTo(Companerismo::class);
    }
}

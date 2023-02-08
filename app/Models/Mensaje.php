<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mensaje extends Model {
    use HasFactory;
    protected $table = 'mensajes';
    protected $fillable = [
        'mensaje',
        'leido'
    ];

    public function sender(): HasOne
    {
        return $this->hasOne(Persona::class, 'sender_id');
    }

    public function receiver(): HasOne
    {
        return $this->hasOne(Persona::class, 'receiver_id');
    }
}

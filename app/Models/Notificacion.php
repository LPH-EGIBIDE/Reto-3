<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Persona {
    use HasFactory;
    protected $table = 'notificaciones';
    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo',
        'url',
        'leido'
    ];

    public function persona() {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}

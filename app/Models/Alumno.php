<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Persona {
    use HasFactory;
    protected $table = 'alumnos';
    protected $primaryKey = 'persona_id';

    public function persona() {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function alumnohistorico() {
        return $this->hasMany(AlumnoHistorico::class);
    }
}

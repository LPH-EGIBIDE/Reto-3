<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilitadorCentro extends Persona {
    use HasFactory;
    protected $table = 'facilitadores_centro';
    protected $primaryKey = 'persona_id';
    public $incrementing = false;

    public function persona() {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function alumnohistorico() {
        return $this->hasMany(AlumnoHistorico::class);
    }
}

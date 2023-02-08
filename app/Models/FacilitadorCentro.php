<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FacilitadorCentro extends Persona {
    use HasFactory;
    protected $table = 'facilitadores_centro';
    protected $primaryKey = 'persona_id';
    public $incrementing = false;

    public function persona(): BelongsTo {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
    public function grado(): HasMany {
        return $this->hasMany(Grado::class, 'coordinador_id');
    }
    public function alumnoHistorico(): HasMany {
        return $this->hasMany(AlumnoHistorico::class, 'facilitador_centro');
    }
}

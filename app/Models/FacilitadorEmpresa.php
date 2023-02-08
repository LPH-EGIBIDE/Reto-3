<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FacilitadorEmpresa extends Persona {
    use HasFactory;
    protected $table = 'facilitadores_empresa';
    protected $primaryKey = 'persona_id';

    public function persona(): BelongsTo {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
    public function empresa(): BelongsTo {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    public function alumnoHistorico(): HasMany {
        return $this->hasMany(AlumnoHistorico::class, 'facilitador_empresa');
    }
}

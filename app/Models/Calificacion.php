<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calificacion extends Model {
    use HasFactory;

    protected $table = 'calificaciones';
    protected $primaryKey = 'historico_id';
    protected $fillable = [
        'calificaciones_practicas',
        'calificaciones_teoricas'
    ];

    public function alumnoHistorico(): BelongsTo {
        return $this->belongsTo(AlumnoHistorico::class, 'historico_id');
    }
}

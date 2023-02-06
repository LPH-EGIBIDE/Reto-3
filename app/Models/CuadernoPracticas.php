<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CuadernoPracticas extends Model {
    use HasFactory;

    protected $table = 'cuaderno_practicas';

    protected $fillable = [
        'semana',
        'estado',
        'observaciones',
        'contenido'
    ];

    public function alumnoHistorico(): BelongsTo {
        return $this->belongsTo(AlumnoHistorico::class, 'historico_id');
    }


}

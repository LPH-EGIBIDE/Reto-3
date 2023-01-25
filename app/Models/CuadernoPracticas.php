<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuadernoPracticas extends Model {
    use HasFactory;

    protected $table = 'cuaderno_practicas';
    protected $primaryKey = 'historico_id';
    protected $fillable = [
        'semana',
        'estado',
        'observaciones',
        'contenido'
    ];

    public function alumnohistorico() {
        return $this->belongsTo(AlumnoHistorico::class, 'historico_id');
    }
}

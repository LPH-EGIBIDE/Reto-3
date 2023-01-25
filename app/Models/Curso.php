<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model {
    use HasFactory;
    protected $table = 'cursos';
    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin'
        // 'fechas_excluidas'
    ];

    public function alumnohistorico() {
        return $this->hasMany(AlumnoHistorico::class);
    }
}

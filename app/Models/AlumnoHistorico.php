<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoHistorico extends Model {
    use HasFactory;
    protected $table = 'alumnos_historicos';
    protected $primaryKey = 'persona_id' . 'curso_id' . 'grado_id';
    protected $fillable = 'estado';

    public function alumno() {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }
    public function curso() {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
    public function grado() {
        return $this->belongsTo(Grado::class, 'grado_id');
    }
    public function facilitadorcentro() {
        return $this->belongsTo(FacilitadorCentro::class, 'facilitador_centro');
    }
    public function facilitadorempresa() {
        return $this->belongsTo(FacilitadorEmpresa::class, 'facilitador_empresa');
    }

    public function cuadernopractica() {
        return $this->hasMany(CuadernoPractica::class);
    }
    public function calificacion() {
        return $this->hasMany(Calificacion::class);
    }
}

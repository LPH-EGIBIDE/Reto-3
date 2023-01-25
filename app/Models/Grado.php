<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model {
    use HasFactory;
    protected $table = 'grados';
    protected $fillable = [
        'nombre'
    ];

    public function familia() {
        return $this->belongsTo(Familia::class, 'familia_id');
    }
    public function facilitadorempresa() {
        return $this->belongsTo(FacilitadorEmpresa::class);
    }

    public function alumnohistorico() {
        return $this->hasMany(AlumnoHistorico::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilitadorEmpresa extends Persona {
    use HasFactory;
    protected $table = 'facilitadores_empresa';
    protected $inherits = Empresa::class;
    protected $primaryKey = 'persona_id';

    public function persona() {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
    public function empresa() {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    public function grado() {
        return $this->hasMany(Grado::class);
    }
    public function alumnohistorico() {
        return $this->hasMany(AlumnoHistorico::class);
    }
}

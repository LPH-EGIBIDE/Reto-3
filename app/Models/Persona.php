<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Persona extends Model {
    use HasFactory;
    protected $table = 'personas';
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'telefono',
    ];

    public function user() {
        return $this->hasMany(User::class);
    }
    public function alumno() {
        return $this->hasMany(Alumno::class);
    }
    public function facilitadorcentro() {
        return $this->hasMany(FacilitadorCentro::class);
    }
    public function facilitadorempresa() {
        return $this->hasMany(FacilitadorEmpresa::class);
    }
    public function attachment() {
        return $this->hasMany(Attachment::class);
    }
    public function notificacion() {
        return $this->hasMany(Notificacion::class);
    }
}

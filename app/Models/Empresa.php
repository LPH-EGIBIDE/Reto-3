<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model {
    use HasFactory;
    protected $table = 'empresas';
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'cif',
        'area',
    ];

    public function facilitadorempresa() {
        return $this->hasMany(FacilitadorEmpresa::class);
    }
}

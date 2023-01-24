<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model {
    use HasFactory;

    protected $table = 'calificaciones';
    protected $fillable = [
        'id_usuario',
        'id_producto',
        'calificacion',
        'comentario',
        'created_at',
        'updated_at'
    ];

}

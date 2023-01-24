<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Persona
{
    use HasFactory;
    protected table = 'alumnos';
    // Inherit all attributes from Persona
    protected $fillable = [
        'id',
    ];

}

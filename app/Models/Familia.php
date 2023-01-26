<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Familia extends Model {
    use HasFactory;
    protected $table = 'familias';
    protected $fillable = [
        'nombre'
    ];

    public function grado(): HasMany {
        return $this->hasMany(Grado::class);
    }
}

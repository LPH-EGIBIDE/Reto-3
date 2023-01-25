<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grado extends Model {
    use HasFactory;
    protected $table = 'grados';
    protected $fillable = [
        'nombre'
    ];

    public function familia(): BelongsTo {
        return $this->belongsTo(Familia::class, 'familia_id');
    }
    public function coordinador(): BelongsTo {
        return $this->belongsTo(Persona::class, 'coordinador_id');
    }

    public function alumnoHistorico(): HasMany {
        return $this->hasMany(Persona::class);
    }
}

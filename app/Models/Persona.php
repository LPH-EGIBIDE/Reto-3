<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Persona extends Model {
    use HasFactory;
    protected $table = 'personas';
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'telefono',
    ];

    public function user(): BelongsTo {
        return $this->hasOne(User::class, 'id');
    }
    public function attachment(): HasMany {
        return $this->hasMany(Attachment::class);
    }
    public function notificacion(): HasMany {
        return $this->hasMany(Notificacion::class);
    }
    public function mensaje(): HasMany {
        return $this->hasMany(Mensaje::class);
    }
}

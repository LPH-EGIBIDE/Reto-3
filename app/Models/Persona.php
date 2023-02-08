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

    public function user(): hasOne {
        return $this->hasOne(User::class, 'persona_id');
    }
    public function attachment(): HasMany {
        return $this->hasMany(Attachment::class);
    }
    public function fotoPerfil(): BelongsTo {
        return $this->belongsTo(Attachment::class, 'profile_pic_id');
    }

    public function notificacion(): HasMany {
        return $this->hasMany(Notificacion::class);
    }
    public function mensajeEnviado(): HasMany {
        return $this->hasMany(Mensaje::class, 'sender_id');
    }
    public function mensajeRecibido(): HasMany {
        return $this->hasMany(Mensaje::class, 'receiver_id');
    }

    public function informacion(): ?HasOne {
        switch ($this->tipo) {
            case 'alumno':
                return $this->hasOne(Alumno::class);
            case 'facilitador_centro':
                return $this->hasOne(FacilitadorCentro::class);
            case 'facilitador_empresa':
                return $this->hasOne(FacilitadorEmpresa::class);
            default:
                return null;
        }
    }
}

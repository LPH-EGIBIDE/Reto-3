<?php

namespace App\Models;

use App\Http\Controllers\CuadernoPracticasController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlumnoHistorico extends Model {
    use HasFactory;
    protected $table = 'alumnos_historicos';
    protected $fillable = [
        'estado'
    ];

    public function alumno(): BelongsTo {
        return $this->belongsTo(Persona::class, 'alumno_id');
    }
    public function curso(): BelongsTo {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
    public function grado(): BelongsTo {
        return $this->belongsTo(Grado::class, 'grado_id');
    }
    public function facilitadorCentro(): BelongsTo {
        return $this->belongsTo(FacilitadorCentro::class, 'facilitador_centro');
    }
    public function facilitadorEmpresa(): BelongsTo {
        return $this->belongsTo(FacilitadorEmpresa::class, 'facilitador_empresa');
    }

    public function cuadernosPracticas(): HasMany {
        return $this->hasMany(CuadernoPracticas::class, 'historico_id');
    }

}

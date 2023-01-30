<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\AlumnoHistorico;
use App\Models\Curso;
use App\Models\Grado;
use App\Models\Mensaje;
use App\Models\Persona;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('alumno', function ($user) {
            return $user->persona->tipo === 'alumno';
        });

        Gate::define('facilitador_centro', function ($user) {
            return $user->persona->tipo  === 'facilitador_centro';
        });

        Gate::define('facilitador_empresa', function ($user) {
            return $user->persona->tipo  === 'facilitador_empresa';
        });

        Gate::define('facilitador', function ($user) {
            return $user->persona->tipo  === 'facilitador_centro' || $user->persona->tipo  === 'facilitador_empresa';
        });

        Gate::define('is_coordinador', function ($user) {
            $grado = Grado::where('coordinador_id', $user->persona->id)->get()->first();
            return $grado !== null;
        });

        Gate::define('can_message', function ($user, $receptor) {
            // Check if the receiver is a facilitador not of the same type
            //TODO: Implement active curso in database
            $lastCurso = Curso::all()->sortBy('id')->last();
            // Depending on the type of the receiver, we need to check that both are related
            $alumnoHistorico = null;
            log::info('User: ' . $user->persona->id . ' Tipo: ' . $user->persona->tipo);
            log::info('Receptor: ' . $receptor->id  . ' Tipo: ' . $receptor->tipo);
            log::info('Last curso: ' . $lastCurso->id);
            if ($receptor->tipo == 'facilitador_centro') {

                // Check if the receiver is related to the sender
                //Check if receiver has a entry in alumnohistorico with the last curso ant the sender is the facilitador
                log::info('Receptor is facilitador_centro');
                $alumnoHistorico = AlumnoHistorico::where('facilitador_centro', $receptor->id)
                    ->where('curso_id', $lastCurso->id)
                    ->where('facilitador_empresa', $user->persona->id)
                    ->first();
            } else if ($receptor->tipo == 'facilitador_empresa') {
                // Check if the receiver is related to the sender
                //Check if receiver has a entry in alumnohistorico with the last curso ant the sender is the facilitador
                log::info('Receptor is facilitador_empresa');
                $alumnoHistorico = AlumnoHistorico::where('facilitador_centro', $user->persona->id)
                    ->where('curso_id', $lastCurso->id)
                    ->where('facilitador_empresa', $receptor->id)
                    ->first();
                log::info('AlumnoHistorico: ' . $alumnoHistorico);
            }
            return $alumnoHistorico !== null;
        });

        //
    }
}

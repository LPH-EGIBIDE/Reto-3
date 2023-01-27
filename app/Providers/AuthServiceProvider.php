<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Grado;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        //
    }
}

<?php

namespace Database\Seeders;

use App\Models\FacilitadorCentro;
use App\Models\FacilitadorEmpresa;
use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        //Create 5 facilitadores_centro and link them to a user
        $alumnos = Persona::factory()->count(25)->alumno()->create();
        $facilitador_centro = Persona::factory()->count(25)->facilitadorCentro()->create();
        $facilitador_empresa = Persona::factory()->count(25)->facilitadorEmpresa()->create();

        $personas = Persona::all();

        foreach ($personas as $persona) {
            \App\Models\User::factory()->create([
                'password' => bcrypt('admin'),
                'persona_id' => $persona->id,
                'email_verified_at' => now()
            ]);
            switch ($persona->tipo) {
                case 'alumno':
                    $alumno = new \App\Models\Alumno();
                    $alumno->persona_id = $persona->id;
                    $alumno->save();
                    break;
                case 'facilitador_centro':
                    $facilitador_centro = new FacilitadorCentro();
                    $facilitador_centro->persona_id = $persona->id;
                    $facilitador_centro->save();
                    break;
                case 'facilitador_empresa':
                    $facilitador_empresa = new FacilitadorEmpresa();
                    $facilitador_empresa->persona_id = $persona->id;
                    $facilitador_empresa->empresa_id = \App\Models\Empresa::all()->random()->id;
                    $facilitador_empresa->save();
                    break;
            }
        }

                //Create 1  and link it to a user
                $admin = new Persona();
                $admin->nombre = 'admin';
                $admin->apellido = 'admin';
                $admin->dni = '12345678A';
                $admin->telefono = '123456789';
                $admin->tipo = 'facilitador_centro';
                $admin->save();

                $facilitador_centro = new FacilitadorCentro();
                $facilitador_centro->persona_id = $admin->id;
                $facilitador_centro->save();


                $user = \App\Models\User::factory()->create([
                    'email' => 'alex.cortes@ikasle.egibide.org',
                    'password' => bcrypt('admin'),
                    'persona_id' => $admin->id,
                    'email_verified_at' => now()
                ]);





    }
}

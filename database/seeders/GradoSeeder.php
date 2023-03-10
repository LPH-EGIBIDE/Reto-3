<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Familia;
use App\Models\Grado;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Create 1 grado, save it and link it to a new familia

        $familia = new Familia();
        $familia->nombre = 'Informática';
        $familia->save();

        $adminUser = User::where('email', 'alex.cortes@ikasle.egibide.org')->first();
        $admin = $adminUser->persona;

        $grado = new Grado();
        $grado->nombre = '1º Ingeniería Informática';
        $grado->familia_id = $familia->id;
        $grado->coordinador_id = $admin->id;
        $grado->save();

        //Create a curso
        $curso = new Curso();
        $curso->nombre = '2022-2023';
        $curso->fecha_inicio = '2022-09-01';
        $curso->fecha_fin = '2023-06-30';
        $curso->save();


    }
}

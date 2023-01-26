<?php

namespace Database\Seeders;

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

        $adminUser = User::where('email', 'admin@admin.com')->first();
        $admin = $adminUser->persona;

        $grado = new Grado();
        $grado->nombre = '1º Ingeniería Informática';
        $grado->familia_id = $familia->id;
        $grado->coordinador_id = $admin->id;
        $grado->save();
    }
}

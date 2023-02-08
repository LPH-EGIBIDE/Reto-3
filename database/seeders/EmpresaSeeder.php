<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\FacilitadorEmpresa;
use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresas = Empresa::factory()->count(10)->create();
    }
}

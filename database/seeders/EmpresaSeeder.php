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
        $facilitadores_empresa = Persona::where('tipo', 'facilitador_empresa')->get();

        foreach ($facilitadores_empresa as $facilitador) {
            $facilitador_empresa = new FacilitadorEmpresa();
            $facilitador_empresa->persona_id = $facilitador->id;
            $facilitador_empresa->empresa_id = $empresas->random()->id;
            $facilitador_empresa->save();
        }


    }
}

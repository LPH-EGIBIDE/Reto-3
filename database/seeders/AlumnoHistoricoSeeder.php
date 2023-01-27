<?php

namespace Database\Seeders;

use App\Models\AlumnoHistorico;
use App\Models\Curso;
use App\Models\Grado;
use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumnoHistoricoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grados = Grado::all();
        $alumnos = Persona::where('tipo', 'alumno')->get();
        $lastCurso = Curso::orderBy('id', 'desc')->first();
        $faciltadores_centro = Persona::where('tipo', 'facilitador_centro')->get();
        $faciltadores_empresa = Persona::where('tipo', 'facilitador_empresa')->get();
        foreach ($alumnos as $alumno) {
            $alumnoHistorico = new AlumnoHistorico();
            $alumnoHistorico->alumno_id = $alumno->id;
            $alumnoHistorico->grado_id = $grados->random()->id;
            $alumnoHistorico->curso_id = $lastCurso->id;
            $alumnoHistorico->facilitador_centro = $faciltadores_centro->random()->id;
            $alumnoHistorico->facilitador_empresa = $faciltadores_empresa->random()->id;
            $alumnoHistorico->estado = 'cursando';
            $alumnoHistorico->save();
        }
    }
}

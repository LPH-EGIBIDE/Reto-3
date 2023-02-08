<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\AlumnoHistorico;
use App\Models\Curso;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $persona = auth()->user()->persona;

        if ($persona->tipo == 'facilitador_centro') {
            //All alumnos
            $alumnos_total = Alumno::all()->count();
            $lastCurso = Curso::getActiveCurso();
            $alumnos_con_empresa = AlumnoHistorico::where('curso_id',$lastCurso->id)
                ->where('facilitador_empresa', '!=', null)
                ->get()->count();
            $alumnos_sin_empresa =  $alumnos_total - $alumnos_con_empresa;
            return view('dashboard',compact('persona'))->with([
                'alumnos_con_empresa' => $alumnos_con_empresa,
                'alumnos_sin_empresa' => $alumnos_sin_empresa,
            ]);
        } else {
            return view('dashboard',compact('persona'));
        }

        return view('dashboard',compact('persona'));
    }
}

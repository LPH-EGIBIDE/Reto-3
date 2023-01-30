<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        //
    }


    public function filterAlumnos(Request $request){
        $request->validate([
            'grado' => 'numeric',
            'empresa' => 'string|max:255',
            'filtro' => 'string|max:255'
        ]);

        //Check if grado is empty and set it to %
        if($request->grado == null || $request->grado == 0){
            $request->grado = '%';
        }

        //Check if empresa is empty and set it to %
        if($request->empresa == null || $request->empresa == 0){
            $request->empresa = '%';
        }
        $lastCurso = DB::table('cursos')->orderBy('id', 'desc')->first();
        $alumnos = DB::table('alumnos')
            ->join('alumnos_historicos', 'alumnos.persona_id', '=', 'alumnos_historicos.alumno_id')
            ->join('personas', 'alumnos.persona_id', '=', 'personas.id')
            ->join('facilitadores_empresa', 'alumnos_historicos.facilitador_empresa', '=', 'facilitadores_empresa.persona_id')
            ->join('empresas', 'facilitadores_empresa.empresa_id', '=', 'empresas.id')
            ->where('alumnos_historicos.curso_id', '=', $lastCurso->id)
            ->where('alumnos_historicos.grado_id', 'like', $request->grado)
            ->where([
                ['personas.nombre', 'like', '%'.$request->filtro.'%', 'or'],
                ['personas.apellido', 'like', '%'.$request->filtro.'%', 'or'],
                ['personas.dni', 'like', '%'.$request->filtro.'%', 'or']
            ])
            ->where('empresas.id', 'like', $request->empresa)
            ->select('personas.nombre', 'personas.apellido', 'personas.dni', 'empresas.nombre as empresa', 'alumnos_historicos.grado_id')
            ->get();
        return $alumnos;
    }
}

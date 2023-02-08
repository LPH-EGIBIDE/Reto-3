<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\AlumnoHistorico;
use App\Models\Curso;
use App\Models\FacilitadorCentro;
use App\Models\FacilitadorEmpresa;
use App\Models\Grado;
use Illuminate\Http\Request;

class AlumnoHistoricoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listaGrados = Grado::all()->sortBy('nombre');
        $listaFacilitadoresCentro = FacilitadorCentro::all()->sortBy('persona.nombre');
        $listaFacilitadoresEmpresa = FacilitadorEmpresa::all()->sortBy('persona.nombre');

        return view('alumno_historicos.create', compact(
            'listaGrados',
            'listaFacilitadoresCentro',
            'listaFacilitadoresEmpresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|int',
            'grado_id' => 'required|int',
            'facilitador_centro' => 'required|int',
            'facilitador_empresa' => 'required|int',
            'estado' => 'required|string',
        ]);

        // Crear alumnoHistorico
        $alumnoHistorico = new AlumnoHistorico();
        $alumnoHistorico->alumno_id = $request->alumno_id;
        $alumnoHistorico->curso_id = Curso::getActiveCurso()->id;
        $alumnoHistorico->grado_id = $request->grado_id;
        $alumnoHistorico->facilitador_centro = $request->facilitador_centro;
        $alumnoHistorico->facilitador_empresa = $request->facilitador_empresa;
        $alumnoHistorico->estado = $request->estado;
        $alumnoHistorico->save();

        session()->flash('message', 'Alumno histórico creado correctamente');
        return redirect()->route('alumno.show', $alumnoHistorico->alumno_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlumnoHistorico  $alumnoHistorico
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $alumnoHistorico = AlumnoHistorico::findOrFail($id);
        $listaGrados = Grado::all()->sortBy('nombre');
        $listaFacilitadoresCentro = FacilitadorCentro::all()->sortBy('persona.nombre');
        $listaFacilitadoresEmpresa = FacilitadorEmpresa::all()->sortBy('persona.nombre');
        return view('alumno_historicos.update', compact('alumnoHistorico',
            'listaGrados',
            'listaFacilitadoresCentro',
            'listaFacilitadoresEmpresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlumnoHistorico  $alumnoHistorico
     * @return \Illuminate\Http\Response
     */
    public function edit(AlumnoHistorico $alumnoHistorico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlumnoHistorico  $alumnoHistorico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'alumno_id' => 'required|int|max:255',
            'grado_id' => 'required|int',
            'facilitador_centro' => 'required|int',
            'facilitador_empresa' => 'required|int',
            'estado' => 'required|string',
        ]);

        $alumnoHistorico = AlumnoHistorico::findOrFail($id);
        $alumnoHistorico->alumno_id = $request->alumno_id;
        $alumnoHistorico->grado_id = $request->grado_id;
        $alumnoHistorico->facilitador_centro = $request->facilitador_centro;
        $alumnoHistorico->facilitador_empresa = $request->facilitador_empresa;
        $alumnoHistorico->estado = $request->estado;
        $alumnoHistorico->save();
        //Set flash data with success message
        session()->flash('success', 'El alumno histórico se ha actualizado correctamente');

        $listaGrados = Grado::all()->sortBy('nombre');
        $listaFacilitadoresCentro = FacilitadorCentro::all()->sortBy('persona.nombre');
        $listaFacilitadoresEmpresa = FacilitadorEmpresa::all()->sortBy('persona.nombre');
        return redirect()->route('alumno.show', compact(
            'listaGrados',
            'listaFacilitadoresCentro',
            'listaFacilitadoresEmpresa'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlumnoHistorico  $alumnoHistorico
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlumnoHistorico $alumnoHistorico)
    {
        //
    }
}

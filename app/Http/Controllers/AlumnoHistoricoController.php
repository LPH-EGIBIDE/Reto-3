<?php

namespace App\Http\Controllers;

use App\Models\AlumnoHistorico;
use Illuminate\Http\Request;

class AlumnoHistoricoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->persona->tipo === 'alumno') {
            $alumno = $user->persona->alumno;
            $historico = $alumno->historico;
            return view('alumno.historico', compact('historico'));
        } else {
            return redirect()->route('home');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumno_historicos.create');
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
     * @param  \App\Models\AlumnoHistorico  $alumnoHistorico
     * @return \Illuminate\Http\Response
     */
    public function show(AlumnoHistorico $alumnoHistorico)
    {
        //
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
    public function update(Request $request, AlumnoHistorico $alumnoHistorico)
    {
        //
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

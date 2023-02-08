<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\AlumnoHistorico;
use App\Models\Calificacion;
use App\Models\Curso;
use Illuminate\Http\Request;

class CalificacionController extends Controller
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
    public function store(Request $request, $id)
    {

        $alumno = Alumno::findOrFail($id);
        \Gate::allows('can_view_alumno', [$alumno]);
        $curso = Curso::getActiveCurso();
        $historico = $alumno->alumnoHistorico->where('curso_id', $curso->id)->first();
        if (!$historico)
            abort(404);

        $calificacion = Calificacion::findOrNew($historico->id);
        $calificacion->historico_id ??= $historico->id;


        switch (auth()->user()->persona->tipo){
            case 'facilitador_centro':
                $this->storeFacilitadorCentro($calificacion, $alumno, $request);
                break;
            case 'facilitador_empresa':
                $this->storeFacilitadorEmpresa($calificacion, $alumno, $request);
                break;
        }
        return redirect()->route('alumno.calificar.index', ['id' => $alumno->id]);
    }

    private function storeFacilitadorCentro(Calificacion $calificacion, Alumno $alumno, Request $request){
        $request->validate([
            'calificacion_1' => 'required|numeric|min:0|max:4',
            'calificacion_2' => 'required|numeric|min:0|max:4',
            'calificacion_3' => 'required|numeric|min:0|max:4',
            'calificacion_4' => 'required|numeric|min:0|max:4',
            'calificacion_5' => 'required|numeric|min:0|max:4',
            'calificacion_6' => 'required|numeric|min:0|max:4',
            'calificacion_7' => 'required|numeric|min:0|max:4',
        ]);
        $calificaciones = [
            'seguimiento' => $request->calificacion_1,
            'orden' => $request->calificacion_2,
            'contenido' => $request->calificacion_3,
            'terminologia' => $request->calificacion_4,
            'calidad' => $request->calificacion_5,
            'conceptos' => $request->calificacion_6,
            'reflexion' => $request->calificacion_7,
        ];

        $calificacion->calificaciones_teoricas = json_encode($calificaciones);
        $calificacion->calificaciones_practicas ??= json_encode([]);
        $calificacion->save();

    }

    private function storeFacilitadorEmpresa(Calificacion $calificacion, Alumno $alumno, Request $request){
        $request->validate([
            'calificacion_1' => 'required|numeric|min:0|max:4',
            'calificacion_2' => 'required|numeric|min:0|max:4',
            'calificacion_3' => 'required|numeric|min:0|max:4',
            'calificacion_4' => 'required|numeric|min:0|max:4',
            'calificacion_5' => 'required|numeric|min:0|max:4',
            'calificacion_6' => 'required|numeric|min:0|max:4',
            'calificacion_7' => 'required|numeric|min:0|max:4',
            'calificacion_8' => 'required|numeric|min:0|max:4',
            'calificacion_9' => 'required|numeric|min:0|max:4',
            'calificacion_10' => 'required|numeric|min:0|max:4',
        ]);
        $calificaciones = [
            'actitud' => $request->calificacion_1,
            'puntualidad' => $request->calificacion_2,
            'responsabilidad' => $request->calificacion_3,
            'capacidad_resolucion' => $request->calificacion_4,
            'calidad_trabajo' => $request->calificacion_5,
            'implicación' => $request->calificacion_6,
            'decisiones' => $request->calificacion_7,
            'capacidad_oral' => $request->calificacion_8,
            'capacidad_planificacion' => $request->calificacion_9,
            'capacidad_aprendizaje' => $request->calificacion_10,
        ];

        $calificacion->calificaciones_practicas = json_encode($calificaciones);
        $calificacion->calificaciones_practicas ??= json_encode([]);
        $calificacion->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calificacion  $calificacion
     */
    public function show($id)
    {
        $alumno = Alumno::findOrFail($id);
        \Gate::allows('can_view_alumno', [$alumno]);
        $curso = Curso::getActiveCurso();
        $historico = $alumno->alumnoHistorico->where('curso_id', $curso->id)->first();
        $calificacion = Calificacion::findOrNew($historico->id);
        $calificacion->historico_id ??= $historico->id;
        $calificaciones_practicas = json_decode($calificacion->calificaciones_practicas, true) ?? [];
        $calificaciones_teoricas = json_decode($calificacion->calificaciones_teoricas, true) ?? [];
        //Check if there are fields empty on the array
        $can_make_average = true;
        $calificaciones_practicas = array_map(function ($calificacion) use (&$can_make_average) {
            if ($calificacion == null) {
                $can_make_average = false;
            }
            return $calificacion;
        }, $calificaciones_practicas);
        $calificaciones_teoricas = array_map(function ($calificacion) use (&$can_make_average) {
            if ($calificacion == null) {
                $can_make_average = false;
            }
            return $calificacion;
        }, $calificaciones_teoricas);

        if ($can_make_average) {
            $calificacion_practica = $this->calculateAverage($calificaciones_practicas);
            $calificacion_teorica = $this->calculateAverage($calificaciones_teoricas);
            $calificacion_final = ($calificacion_practica + $calificacion_teorica) / 2;
        } else {
            $calificacion_practica = null;
            $calificacion_teorica = null;
            $calificacion_final = null;
        }

        return view('calificaciones.show', [
            'persona' => $alumno->persona,
            'calificaciones_practicas' => $calificaciones_practicas,
            'calificaciones_teoricas' => $calificaciones_teoricas,
            'calificacion_total' => $calificacion_final,
            ]);
    }

    private function calculateAverage($calificaciones){
        $calificacion_sum = 0;
        $calificaciones_values = [2,4,6,8,10];
        foreach ($calificaciones as $key => $calificacion){

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        \Gate::allows('can_view_alumno', [$alumno]);
        $curso = Curso::getActiveCurso();
        $historico = $alumno->alumnoHistorico->where('curso_id', $curso->id)->first();
        $calificacion = Calificacion::findOrNew($historico->id);
        $calificacion->historico_id ??= $historico->id;

        switch (auth()->user()->persona->tipo){
            case 'facilitador_centro':

                return view('facilitador_centro.calificar', [
                    'persona' => $alumno->persona,
                    'calificacion' => $calificacion->calificaciones_teoricas ?? [],
                ]);
            case 'facilitador_empresa':
                return view('facilitador_empresa.calificar', [
                    'persona' => $alumno->persona,
                    'calificacion' => $calificacion->calificaciones_practicas ?? [],
                ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calificacion  $calificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calificacion $calificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calificacion  $calificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calificacion $calificacion)
    {
        //
    }
}

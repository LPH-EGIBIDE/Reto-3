<?php

namespace App\Http\Controllers;

use App\Mail\CalificacionesMail;
use App\Models\Alumno;
use App\Models\AlumnoHistorico;
use App\Models\Calificacion;
use App\Models\Curso;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        if (!empty($calificacion->calificaciones_practicas) && !empty($calificacion->calificaciones_teoricas)){
            Mail::to($alumno->persona->user->email)->send(new CalificacionesMail("Calificaciones publicadas", $alumno));
            $notificacion = new Notificacion();
            $notificacion->persona_id = $alumno->persona_id;
            $notificacion->titulo = "Calificaciones";
            $notificacion->descripcion = "Tus calificaciones han sido publicadas";
            $notificacion->tipo = 1;
            $notificacion->url = route('alumno.calificaciones');
            $notificacion->save();
        }

        return redirect()->route('alumno.calificar.show', ['id' => $alumno->persona_id]);
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
        session()->flash('message', 'Calificaciones teoricas guardadas correctamente');

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
            'implicaci??n' => $request->calificacion_6,
            'decisiones' => $request->calificacion_7,
            'capacidad_oral' => $request->calificacion_8,
            'capacidad_planificacion' => $request->calificacion_9,
            'capacidad_aprendizaje' => $request->calificacion_10,
        ];

        $calificacion->calificaciones_practicas = json_encode($calificaciones);
        $calificacion->calificaciones_teoricas ??= json_encode([]);
        $calificacion->save();
        session()->flash('message', 'Calificaciones practicas guardadas correctamente');
    }

    public function showAlumno() {
        return $this->show(auth()->user()->persona_id);
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

            $calificacion_practica = $this->calculateAverage($calificaciones_practicas);
            $calificacion_teorica = $this->calculateAverage($calificaciones_teoricas);
            $calificacion_final = ($calificacion_practica + $calificacion_teorica) / 2;

        return view('calificaciones.show', [
            'persona' => $alumno->persona,
            'calificaciones_practicas' => $calificaciones_practicas,
            'calificaciones_teoricas' => $calificaciones_teoricas,
            'calificacion_total' => round($calificacion_final, 2),
            'nombre_calificaciones' => ['Insuficiente', 'Suficiente', 'Bien', 'Notable', 'Sobresaliente', 'Sin calificar'],
            ]);
    }

    private function calculateAverage($calificaciones){
        $calificacion_sum = 0;
        $calificaciones_values = [2,5,6,8,10];
        foreach ($calificaciones as $key => $calificacion){
            $calificacion_sum += $calificaciones_values[$calificacion];
        }
        try {
            return $calificacion_sum / count($calificaciones);
        } catch (\DivisionByZeroError $e) {
            return 0;
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
                    'calificacion' => json_decode($calificacion->calificaciones_teoricas, true) ?? [],
                ]);
            case 'facilitador_empresa':
                return view('facilitador_empresa.calificar', [
                    'persona' => $alumno->persona,
                    'calificacion' => json_decode($calificacion->calificaciones_practicas, true) ?? [],
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

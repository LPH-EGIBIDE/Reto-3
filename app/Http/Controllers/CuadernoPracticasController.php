<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\CuadernoPracticas;
use App\Models\User;
use Illuminate\Http\Request;

class CuadernoPracticasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id = null)
    {
        if ($user_id == null){
            $persona = auth()->user()->persona;
        }else{
            $alumno = Alumno::findOrFail($user_id);
            $persona = $alumno->persona;
            \Gate::allows('can_view_alumno', $alumno);
        }
        $historico = $persona->informacion->alumnoHistorico->last();
        $curso = $historico->curso;
        if ($curso == null)
            return redirect()->route('home')->withErrors(['No se ha encontrado un curso activo']);
        //Generate weeks array based on the start and end date of the course
        $weeks = [];
        $start = new \DateTime($curso->fecha_inicio);
        $end = new \DateTime($curso->fecha_fin);

        $interval = new \DateInterval('P1W');
        $daterange = new \DatePeriod($start, $interval ,$end);
        $week = 1;
        foreach($daterange as $date){
            //Check if week start day is greater than today
            if($date->format("Y-m-d") > date("Y-m-d"))
                break;
            $weeks[] = [$week, "Semana {$week} - ".$date->format("Y-m-d")];
            $week++;
        }
        if ($user_id == null)
            return view('cuaderno_practicas.create', compact('weeks', 'persona'));
        else
            return view('cuaderno_practicas.show', compact('weeks', 'persona'));

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
        $request->validate([
            'semana' => 'nullable|integer'
        ]);
        $week = $request->semana;
        $user = auth()->user();
        $historico = $user->persona->informacion->alumnoHistorico->last();
        $curso = $historico->curso;
        if ($curso == null)
            return redirect()->route('home')->withErrors(['No se ha encontrado un curso activo']);
        //Calculate the number of weeks based on the start and end date of the course
        $start = new \DateTime($curso->fecha_inicio);
        $end = new \DateTime($curso->fecha_fin);

        $interval = new \DateInterval('P1W');
        $daterange = new \DatePeriod($start, $interval ,$end);
        $week_count = 1;
        foreach($daterange as $date){
            //Check if week start day is greater than today
            if($date->format("Y-m-d") > date("Y-m-d"))
                break;
            $week_count++;
        }
        //Check if the week is valid and if the week is greater than the start date of the current week
        if($week > $week_count || $week < 1)
            return ["error" => "La semana no es válida"];

        //Return the cuaderno de practicas for the week with structure even if it is empty
        $cuaderno = $historico->cuadernosPracticas->where('semana', $week)->first();

        return $cuaderno == null ? ["error" => "Error recuperando informacion"] : $cuaderno;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CuadernoPracticas  $cuadernoPracticas
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $user_id = null)
    {
        $request->validate([
            'semana' => 'nullable|integer'
        ]);
        $week = $request->semana;
        if ($user_id == null){
            $persona = auth()->user()->persona;
        }else{
            $alumno = Alumno::findOrFail($user_id);
            $persona = $alumno->persona;
            \Gate::allows('can_view_alumno', $alumno);
        }
        $historico = $persona->informacion->alumnoHistorico->last();
        $curso = $historico->curso;
        if ($curso == null)
            return redirect()->route('home')->withErrors(['No se ha encontrado un curso activo']);
        //Calculate the number of weeks based on the start and end date of the course
        $start = new \DateTime($curso->fecha_inicio);
        $end = new \DateTime($curso->fecha_fin);

        $interval = new \DateInterval('P1W');
        $daterange = new \DatePeriod($start, $interval ,$end);
        $week_count = 1;
        foreach($daterange as $date){
            //Check if week start day is greater than today
            if($date->format("Y-m-d") > date("Y-m-d"))
                break;
            $week_count++;
        }
        //Check if the week is valid and if the week is greater than the start date of the current week
        if($week > $week_count || $week < 1)
            return ["error" => "La semana no es válida"];

        //Return the cuaderno de practicas for the week with structure even if it is empty
        $cuaderno = $historico->cuadernosPracticas->where('semana', $week)->first();
        if($cuaderno == null){
            $cuaderno = new CuadernoPracticas();
            $cuaderno->semana = $week;
            $cuaderno->historico_id = $historico->id;
            $cuaderno->estado = 0;
            $cuaderno->observaciones = "";
            $cuaderno->contenido_actividades = "";
            $cuaderno->contenido_reflexion = "";
            $cuaderno->contenido_problemas = "";
            $cuaderno->save();
        }

        return $cuaderno;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CuadernoPracticas  $cuadernoPracticas
     * @return \Illuminate\Http\Response
     */
    public function edit(CuadernoPracticas $cuadernoPracticas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CuadernoPracticas  $cuadernoPracticas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'semana' => 'required|integer',
            'contenido_actividades' => 'nullable|string',
            'contenido_reflexion' => 'nullable|string',
            'contenido_problemas' => 'nullable|string'
        ]);
        $week = $request->semana;
        $user = auth()->user();
        $historico = $user->persona->informacion->alumnoHistorico->last();

        $cuaderno = $historico->cuadernosPracticas->where('semana', $week)->first();
        if($cuaderno == null){
            return redirect()->back()->withErrors(['error' => 'Error recuperando información']);
        }
        if ($cuaderno->estado == 2)
            return redirect()->back()->withErrors(['error' => 'No se puede editar un cuaderno de prácticas que ya ha sido evaluado por el profesor']);

        $cuaderno->contenido_actividades = $request->contenido_actividades;
        $cuaderno->contenido_reflexion = $request->contenido_reflexion;
        $cuaderno->contenido_problemas = $request->contenido_problemas;
        //Check if all the fields are filled
        $successMessage = "Cuaderno de prácticas actualizado correctamente";
        if($cuaderno->contenido_actividades != "" && $cuaderno->contenido_reflexion != "" && $cuaderno->contenido_problemas != ""){
            $cuaderno->estado = 1;
            $successMessage = "Cuaderno de prácticas actualizado correctamente y enviado al profesor";
        } else
            $cuaderno->estado = 0;
        $cuaderno->save();
        session()->flash('message', $successMessage);
        return redirect()->back();


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CuadernoPracticas  $cuadernoPracticas
     * @return \Illuminate\Http\Response
     */
    public function evaluar(Request $request, $user_id)
    {
        $request->validate([
            'semana' => 'required|integer',
            'observaciones' => 'nullable|string',
        ]);
        $week = $request->semana;
        $alumno = Alumno::findOrFail($user_id);
        $persona = $alumno->persona;
        \Gate::allows('can_view_alumno', $alumno);

        $historico = $persona->informacion->alumnoHistorico->last();

        $cuaderno = $historico->cuadernosPracticas->where('semana', $week)->first();
        if($cuaderno == null){
            return redirect()->back()->withErrors(['error' => 'Error recuperando información']);
        }

        $cuaderno->observaciones = $request->observaciones;
        //Check if all the fields are filled
        if ($cuaderno->observaciones != ""){
            $successMessage = "Cuaderno de seguimiento evaluado correctamente, el alumno ha sido notificado y no podrá volver a editar esta semana";
            $cuaderno->estado = 2;
        } else {
            $successMessage = "Evalución del cuaderno de seguimiento eliminada correctamente, el alumno podrá volver a editar esta semana";
            $cuaderno->estado = 1;
        }
        $cuaderno->save();
        session()->flash('message', $successMessage );
        return redirect()->back();


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CuadernoPracticas  $cuadernoPracticas
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuadernoPracticas $cuadernoPracticas)
    {
        //
    }
}

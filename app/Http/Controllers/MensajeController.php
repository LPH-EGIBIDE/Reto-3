<?php

namespace App\Http\Controllers;

use App\Models\AlumnoHistorico;
use App\Models\Curso;
use App\Models\Mensaje;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('messagecenter');
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'mensaje' => 'required|max:255',
            'receiver_id' => 'required|numeric',
        ]);


        // Check if the receiver is a facilitaddr not of the same type
        $receiver = Persona::find($request->receiver_id);
        //TODO: Implement active curso in database
        $lastCurso = Curso::all()->sortBy('id')->last();
            // Depending on the type of the receiver, we need to check that both are related
            if ($receiver->tipo_facilitador == 'facilitador_centro') {
                // Check if the receiver is related to the sender
                //Check if receiver has a entry in alumnohistorico with the last curso ant the sender is the facilitador
                $alumnoHistorico = AlumnoHistorico::where('facilitador_empresa', $receiver->id)
                    ->where('curso_id', $lastCurso->id)
                    ->where('facilitador_centro', auth()->user()->persona->id)
                    ->first();

                if ($alumnoHistorico) {
                    // Create the message
                    $mensaje = new Mensaje();
                    $mensaje->mensaje = $request->mensaje;
                    $mensaje->sender_id = auth()->user()->persona->id;
                    $mensaje->receiver_id = $request->receiver_id;
                    $mensaje->save();
                }

            } else if ($receiver->tipo_facilitador == 'facilitador_empresa') {
                // Check if the receiver is related to the sender
                //Check if receiver has a entry in alumnohistorico with the last curso ant the sender is the facilitador
                $alumnoHistorico = AlumnoHistorico::where('facilitador_empresa', auth()->user()->persona->id)
                    ->where('curso_id', $lastCurso->id)
                    ->where('facilitador_centro', $receiver->id)
                    ->first();
                if ($alumnoHistorico) {
                    // Create the message
                    $mensaje = new Mensaje();
                    $mensaje->mensaje = $request->mensaje;
                    $mensaje->sender_id = auth()->user()->persona->id;
                    $mensaje->receiver_id = $request->receiver_id;
                    $mensaje->save();
                }
            }
        return redirect()->route('mensaje.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function show(Mensaje $mensaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensaje $mensaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mensaje $mensaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensaje $mensaje)
    {
        //
    }
}

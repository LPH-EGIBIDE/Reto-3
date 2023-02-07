<?php

namespace App\Http\Controllers;

use App\Mail\NewUserMail;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PersonaController extends Controller
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
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //
    }

    public function newPersonaEmail(Persona $persona, string $subject, \stdClass $data) {
        Mail::to($persona->user->email)->send(new NewUserMail($subject, $data));
    }

    public function showProfile() {
        $persona = auth()->user()->persona;
        return view('profile.show', ['persona' => $persona]);
    }

    public function changePassword(Request $request) {
        $request->validate([
            'actualPass' => 'required',
            'newPass' => 'required|confirmed|min:8',
        ]);
        $user = auth()->user();
        if (!\Hash::check($request->actualPass, $user->password)) {
            return redirect()->back()->withErrors(['actualPass' => 'La contraseña actual no es correcta']);
        }
        $user->password = \Hash::make($request->newPass);
        $user->save();
        //TODO: Enviar correo de cambio de contraseña

        session()->flash('status', 'Contraseña cambiada correctamente. Inicie sesión de nuevo para aplicar los cambios.');
        auth()->logout();
        return redirect()->route('login');
    }
}

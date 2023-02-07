<?php

namespace App\Http\Controllers;

use App\Models\FacilitadorCentro;
use App\Models\FacilitadorEmpresa;
use App\Models\Persona;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;

class FacilitadorCentroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('facilitador_centro.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facilitador_centro.create');
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
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|min:9|max:9|unique:personas',
            'telefono' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        // Crear persona
        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->dni = $request->dni;
        $persona->telefono = $request->telefono;
        $persona->tipo = 'facilitador_centro';
        $persona->save();

        // Crear facilitadorCentro
        $facilitadorCentro = new FacilitadorCentro();
        $facilitadorCentro->persona_id = $persona->id;
        $facilitadorCentro->save();

        // Random password
        $password = substr(md5(microtime()),rand(0,26),8);

        // Crear usuario
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($password);
        $user->persona_id = $persona->id;
        $user->email_verified_at = now();
        $user->save();

        // Enviar email
        $data = (object)array(
            'nombre' => $persona->nombre,
            'apellido' => $persona->apellido,
            'email' => $user->email,
            'password' => $password
        );

        (new PersonaController)->newPersonaEmail($persona, 'Creación de cuenta', $data);

        session()->flash('message', 'Facilitador de centro creado correctamente. Se le ha enviado un correo con sus credenciales');
        return redirect()->route('facilitador-centro.show', ['id' => $persona->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacilitadorCentro  $facilitadorCentro
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $facilitadorCentro = FacilitadorCentro::findOrFail($id);
        return view('facilitador_centro.show', compact('facilitadorCentro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacilitadorCentro  $facilitadorCentro
     * @return \Illuminate\Http\Response
     */
    public function edit(FacilitadorCentro $facilitadorCentro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacilitadorCentro  $facilitadorCentro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|min:9|max:9',
            'telefono' => 'required|string|max:255'
        ]);

        $facilitadorCentro = FacilitadorCentro::findOrFail($id);
        $facilitadorCentro->persona->nombre = $request->nombre;
        $facilitadorCentro->persona->apellido = $request->apellido;
        $facilitadorCentro->persona->dni = $request->dni;
        $facilitadorCentro->persona->telefono = $request->telefono;
        $facilitadorCentro->persona->save();
        session()->flash('message', 'Facilitador actualizado correctamente');
        return view('facilitador_centro.show', ['facilitadorCentro' => $facilitadorCentro]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacilitadorCentro  $facilitadorCentro
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacilitadorCentro $facilitadorCentro)
    {
        //
    }

    public function listado(Request $request)
    {
        $request->validate([
            'page' => 'nullable|integer',
            'filtro' => 'nullable|string|max:255',
        ]);

        $page = $request->input('page', 1);
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $facilitadoresCentro = FacilitadorCentro::join('personas', 'personas.id', '=', 'facilitadores_centro.persona_id')
            ->where('nombre', "like", "%".$request->filtro."%")
            ->select( 'nombre', 'apellido', 'dni', "telefono", "personas.id as url");
        $total = $facilitadoresCentro->count();
        $facilitadoresCentro = $facilitadoresCentro->offset($offset)->limit($perPage)->get();

        $facilitadoresCentro->map(function($facilitadorCentro){
            $facilitadorCentro->url = route('facilitador-centro.show', $facilitadorCentro->url, false);
        });

        $page = intval($page) > ceil($total / $perPage) ? ceil($total / $perPage) : $page;

        return response([
            'data' => $facilitadoresCentro,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
        ], 200, [
            'Content-Type' => 'application/json',
        ], JSON_PRETTY_PRINT);
    }
}

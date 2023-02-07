<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\FacilitadorEmpresa;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;

class FacilitadorEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('facilitador_empresa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::all();
        return view('facilitador_empresa.create', compact('empresas'));
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
            'id_empresa' => 'integer|nullable',
        ]);

        // Crear persona
        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->dni = $request->dni;
        $persona->telefono = $request->telefono;
        $persona->tipo = 'facilitador_empresa';
        $persona->save();

        // Crear facilitadorCentro
        $facilitadorEmpresa = new FacilitadorEmpresa();
        $facilitadorEmpresa->persona_id = $persona->id;
        $facilitadorEmpresa->empresa_id = $request->id_empresa;
        $facilitadorEmpresa->save();

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
        return redirect()->route('facilitador-empresa.show', ['id' => $persona->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacilitadorEmpresa  $facilitadorEmpresa
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $facilitadorEmpresa = FacilitadorEmpresa::findOrFail($id);
        $empresas = Empresa::all();
        return view('facilitador_empresa.show', compact('facilitadorEmpresa', 'empresas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacilitadorEmpresa  $facilitadorEmpresa
     * @return \Illuminate\Http\Response
     */
    public function edit(FacilitadorEmpresa $facilitadorEmpresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacilitadorEmpresa  $facilitadorEmpresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|min:9|max:9',
            'telefono' => 'required|string|max:255',
            'id_empresa' => 'integer|nullable',
        ]);


        $facilitadorEmpresa = FacilitadorEmpresa::findOrFail($id);
        $facilitadorEmpresa->persona->nombre = $request->nombre;
        $facilitadorEmpresa->persona->apellido = $request->apellido;
        $facilitadorEmpresa->persona->dni = $request->dni;
        $facilitadorEmpresa->persona->telefono = $request->telefono;
        $empresa = Empresa::find($request->id_empresa);
        if ($empresa) {
            $facilitadorEmpresa->empresa_id = $request->id_empresa;
        } else {
            $facilitadorEmpresa->empresa_id = null;
        }
        $facilitadorEmpresa->persona->save();
        $empresas = Empresa::all();

        session()->flash('message', 'Facilitador actualizado correctamente');
        return view('facilitador_empresa.show', compact('facilitadorEmpresa', 'empresas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacilitadorEmpresa  $facilitadorEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacilitadorEmpresa $facilitadorEmpresa)
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

        $facilitadoresEmpresa = FacilitadorEmpresa::join('personas', 'personas.id', '=', 'facilitadores_empresa.persona_id')
            ->join('empresas', 'empresas.id', '=', 'facilitadores_empresa.empresa_id')
            ->where('personas.nombre', "like", "%".$request->filtro."%")
            ->select( 'personas.nombre', 'apellido', 'dni', "personas.telefono", "empresas.nombre as empresa" , "personas.id as url");
        $total = $facilitadoresEmpresa->count();
        $facilitadoresEmpresa = $facilitadoresEmpresa->offset($offset)->limit($perPage)->get();

        $facilitadoresEmpresa->map(function($facilitadorEmpresa){
            $facilitadorEmpresa->url = route('facilitador-empresa.show', $facilitadorEmpresa->url, false);
        });

        $page = intval($page) > ceil($total / $perPage) ? ceil($total / $perPage) : $page;

        return response([
            'data' => $facilitadoresEmpresa,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
        ], 200, [
            'Content-Type' => 'application/json',
        ], JSON_PRETTY_PRINT);
    }
}

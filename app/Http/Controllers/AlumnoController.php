<?php

namespace App\Http\Controllers;

use App\Mail\NewUserMail;
use App\Models\Alumno;
use App\Models\Persona;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->persona->tipo === 'alumno') {
            $alumno = $user->persona->alumno;
            $cursos = $alumno->cursos;
            return view('alumno.index', compact('cursos'));
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
        return view('alumno.create');
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
            'email' => 'required|string|email|max:255|unique:users'
        ]);

        // Crear persona
        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->dni = $request->dni;
        $persona->telefono = $request->telefono;
        $persona->tipo = 'alumno';
        $persona->save();

        // Crear alumno
        $alumno = new Alumno();
        $alumno->persona_id = $persona->id;
        $alumno->save();

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

        session()->flash('message', 'Alumno creado correctamente');
        return redirect()->route('alumno.show', ['id' => $persona->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno = Alumno::findOrFail($id);
        if (Gate::denies('can_view_alumno', [$alumno])) {
            abort(403);
        }
        return view('alumno.show', ['alumno' => $alumno]);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|min:9|max:9',
            'telefono' => 'required|string|max:255'
        ]);

        $alumno = Alumno::findOrFail($id);
        if (Gate::denies('can_view_alumno', [$alumno])) {
            abort(403);
        }
        $alumno->persona->nombre = $request->nombre;
        $alumno->persona->apellido = $request->apellido;
        $alumno->persona->dni = $request->dni;
        $alumno->persona->telefono = $request->telefono;
        $alumno->persona->save();
        session()->flash('message', 'Alumno actualizado correctamente');
        return view('alumno.show', ['alumno' => $alumno]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        if (Gate::denies('can_view_alumno', [$alumno])) {
            abort(403);
        }
        $alumno->persona->delete();
        session()->flash('message', 'Alumno eliminado correctamente');
        return redirect()->route('alumnos.index');
    }


    public function filterAlumnos(Request $request){
        $request->validate([
            'grado' => 'numeric',
            'empresa' => 'string|max:255',
            'filtro' => 'string|max:255',
            'page' => 'numeric|nullable'
        ]);

        //Check if grado is empty and set it to %
        if($request->grado == null || $request->grado == 0){
            $request->grado = '%';
        }

        //Check if empresa is empty and set it to %
        if($request->empresa == null || $request->empresa == 0){
            $request->empresa = '%';
        }

        $page = $request->input('page', 1);
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $lastCurso = DB::table('cursos')->orderBy('id', 'desc')->first();
        $alumnos = DB::table('alumnos')
            ->join('alumnos_historicos', 'alumnos.persona_id', '=', 'alumnos_historicos.alumno_id')
            ->join('personas', 'alumnos.persona_id', '=', 'personas.id')
            ->join('facilitadores_empresa', 'alumnos_historicos.facilitador_empresa', '=', 'facilitadores_empresa.persona_id')
            ->join('empresas', 'facilitadores_empresa.empresa_id', '=', 'empresas.id')
            ->where('alumnos_historicos.curso_id', '=', $lastCurso->id)
            ->where('alumnos_historicos.grado_id', 'like', $request->grado)
            ->where(function($query) use ($request){
                $query->whereRaw('CONCAT(personas.nombre, " ", personas.apellido) like "%'.$request->filtro.'%"')
                    ->orWhere('personas.dni', 'like', '%'.$request->filtro.'%');
            })
            ->where('empresas.id', 'like', $request->empresa)
            ->select('personas.nombre', 'personas.apellido', 'personas.dni', 'empresas.nombre as empresa', 'alumnos_historicos.grado_id');

        $total = $alumnos->count();
        $paginated = $alumnos->offset($offset)->limit($perPage)->get();
        return response([
            'data' => $paginated,
            'total' => $total,
            'page' => intval($page),
            'per_page' => $perPage,
        ], 200, [
            'Content-Type' => 'application/json',
        ], JSON_PRETTY_PRINT);
    }
}

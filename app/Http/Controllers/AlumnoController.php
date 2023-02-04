<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Persona;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('alumno.index');
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
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|email|max:255',
            'telefono' => 'required|string|max:255'
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

        session()->flash('message', 'Alumno creado correctamente');
        return redirect()->route('alumnos.show', compact('alumno'));


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
            'dni' => 'required|string|email|max:255',
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
        return view('alumno.index');
    }


    public function filterAlumnos(Request $request){
        $request->validate([
            'grado' => 'numeric',
            'empresa' => 'string|max:255',
            'filtro' => 'string|nullable|max:255',
            'page' => 'numeric|nullable'
        ]);


        //Check if grado is empty and set it to %
        $request->grado = empty($request->grado) ? '%' : $request->grado;

        //Check if empresa is empty and set it to %
        $request->empresa = empty($request->empresa) ? '%' : $request->empresa;

        $page = $request->input('page', 1);
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $lastCurso = DB::table('cursos')->orderBy('id', 'desc')->first();
        $alumnos = DB::table('alumnos')
            ->leftJoin('alumnos_historicos', 'alumnos.persona_id', '=', 'alumnos_historicos.alumno_id')
            ->join('personas', 'alumnos.persona_id', '=', 'personas.id')
            ->join('users', 'alumnos.persona_id', '=', 'users.persona_id')
            ->leftJoin('facilitadores_empresa', 'alumnos_historicos.facilitador_empresa', '=', 'facilitadores_empresa.persona_id')
            ->leftJoin('empresas', 'facilitadores_empresa.empresa_id', '=', 'empresas.id')
            ->where('alumnos_historicos.curso_id', '=', $lastCurso->id)
            ->where('alumnos_historicos.grado_id', 'like', $request->grado)
            ->where(function($query) use ($request){
                $query->whereRaw('CONCAT(personas.nombre, " ", personas.apellido) like "%'.$request->filtro.'%"')
                    ->orWhere('personas.dni', 'like', '%'.$request->filtro.'%');
            })
            ->where('empresas.id', 'like', $request->empresa)
            ->select('personas.nombre', 'personas.apellido', 'personas.dni', 'empresas.nombre as empresa', 'users.email', 'personas.id as url');

        $total = $alumnos->count();
        $paginated = $alumnos->offset($offset)->limit($perPage)->get();
        //Replace persona_id with the route to the show view without using foreach

        array_map(function($alumno){
            $alumno->url = route('alumno.show', $alumno->url, false);
        }, $paginated->all());
        $page = intval($page) > ceil($total / $perPage) ? ceil($total / $perPage) : $page;
        return response([
            'data' => $paginated,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
        ], 200, [
            'Content-Type' => 'application/json',
        ], JSON_PRETTY_PRINT);
    }
}

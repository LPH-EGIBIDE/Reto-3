<?php

namespace App\Http\Controllers;

use App\Mail\NewUserMail;
use App\Models\Alumno;
use App\Models\Attachment;
use App\Models\Curso;
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
        return view('alumno.index');
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
            'email' => 'required|string|email|max:255|unique:users',
            'profile_image' => 'image|nullable|max:10240'
        ]);

        // Crear persona
        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->dni = $request->dni;
        $persona->telefono = $request->telefono;
        $persona->tipo = 'alumno';
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $attachment = (new AttachmentController())->store($file, 'profile_image');
            $persona->profile_pic_id = $attachment->id;
        }
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
            'telefono' => 'required|string|max:255',
            'profile_image' => 'image|nullable|max:10240'
        ]);

        $alumno = Alumno::findOrFail($id);
        if (Gate::denies('can_view_alumno', [$alumno])) {
            abort(403);
        }
        $alumno->persona->nombre = $request->nombre;
        $alumno->persona->apellido = $request->apellido;
        $alumno->persona->dni = $request->dni;
        $alumno->persona->telefono = $request->telefono;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $attachment = (new AttachmentController())->store($file, 'profile_image');
            if ($alumno->persona->profile_pic_id) {
                $old_attachment = Attachment::findOrFail($alumno->persona->profile_pic_id);
                $old_attachment->delete();
            }
            $alumno->persona->profile_pic_id = $attachment->id;
        }
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

        $lastCurso = Curso::getActiveCurso();
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



    public function search(Request $request){
        $request->validate([
            'filtro' => 'string|nullable|max:255'
        ]);
        if (strlen($request->filtro) < 3) {
            return response([
                'data' => [],
            ], 200, [
                'Content-Type' => 'application/json',
            ], JSON_PRETTY_PRINT);
        }

        $alumnos = Persona::where('tipo', '=', 'alumno')
            ->where(function($query) use ($request){
                $query->whereRaw('CONCAT(nombre, " ", apellido) like "%'.$request->filtro.'%"')
                    ->orWhere('dni', 'like', '%'.$request->filtro.'%');
            })
            ->select('id', 'nombre', 'apellido')->get();

        array_map(function($alumno){
            $alumno->nombre = $alumno->nombre . ' ' . $alumno->apellido;
            unset($alumno->apellido);
        }, $alumnos->all());

        return response([
            'data' => $alumnos,
        ], 200, [
            'Content-Type' => 'application/json',
        ], JSON_PRETTY_PRINT);
    }

    //Calificar Alumnos

    public function calificarIndex(){
        return view('facilitador_centro.alumnos.calificarindex');
    }

    public function filterCalificar(Request $request)
    {

        $request->validate([
            'filtro' => 'string|nullable|max:255',
            'all' => 'boolean|nullable',
            'page' => 'numeric|nullable'
        ]);

        $request->all = empty($request->all) ? false : $request->all;

        $persona = auth()->user()->persona;
        $tipo = $persona->tipo;

        $page = $request->input('page', 1);
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $lastCurso = Curso::getActiveCurso();

        $alumnos = Alumno::join('alumnos_historicos', 'alumnos.persona_id', '=', 'alumnos_historicos.alumno_id')
            ->join('personas', 'alumnos.persona_id', '=', 'personas.id')
            ->leftJoin('facilitadores_empresa', 'alumnos_historicos.facilitador_empresa', '=', 'facilitadores_empresa.persona_id')
            ->leftJoin('empresas', 'facilitadores_empresa.empresa_id', '=', 'empresas.id')
            ->leftJoin('calificaciones', 'alumnos_historicos.id', '=', 'calificaciones.historico_id')
            ->where('alumnos_historicos.curso_id', '=', $lastCurso->id);
                switch ($tipo){
                    case 'facilitador_centro':
                        $alumnos = $alumnos->where('alumnos_historicos.facilitador_centro', '=', $persona->id);
                        if(!$request->all)
                            $alumnos = $alumnos->where('calificaciones.calificaciones_teoricas', '=', null);
                        break;
                    case 'facilitador_empresa':
                        $alumnos = $alumnos->where('alumnos_historicos.facilitador_empresa', '=', $persona->id);
                        if(!$request->all)
                            $alumnos = $alumnos->where('calificaciones.calificaciones_practicas', '=', null);
                        break;
                }

        $alumnos = $alumnos->where(function($query) use ($request){
            $query->whereRaw('CONCAT(personas.nombre, " ", personas.apellido) like "%'.$request->filtro.'%"')
                ->orWhere('personas.dni', 'like', '%'.$request->filtro.'%');
        })
            ->select('personas.nombre', 'personas.apellido', 'personas.dni', 'empresas.nombre as empresa', 'personas.id as url');

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

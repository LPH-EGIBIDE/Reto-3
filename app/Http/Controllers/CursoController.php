<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cursos.index');
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

        $cursos = Curso::where('nombre', "like", "%".$request->filtro."%")->offset($offset)->limit($perPage)->select( 'nombre', 'fecha_inicio', 'fecha_fin', "id as url");
        $total = $cursos->count();
        $cursos = $cursos->get();

        $cursos->map(function($curso){
            $curso->url = route('curso.show', $curso->url, false);
        });

        $page = intval($page) > ceil($total / $perPage) ? ceil($total / $perPage) : $page;

        return response([
            'data' => $cursos,
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
        ], 200, [
            'Content-Type' => 'application/json',
        ], JSON_PRETTY_PRINT);
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
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);
        $curso = new Curso();
        $curso->nombre = $request->nombre;
        $curso->fecha_inicio = $request->fecha_inicio;
        $curso->fecha_fin = $request->fecha_fin;
        $curso->save();
        session()->flash('success', 'Curso creado correctamente');
        return redirect()->route('cursos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::findOrFail($id);
        return view('cursos.show', compact('curso'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'active' => 'required|numeric',
        ]);
        $curso = Curso::findOrFail($id);
        $curso->nombre = $request->nombre;
        $curso->fecha_inicio = $request->fecha_inicio;
        $curso->fecha_fin = $request->fecha_fin;
        $curso->active = $request->active;
        $curso->save();
        //Set flash data with success message
        session()->flash('success', 'El curso fue actualizado correctamente');
        return redirect()->route('curso.show', $curso->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $curso = Curso::findOrFail($id);
        $curso->delete();
        //Set flash data with success message
        session()->flash('success', 'El curso fue eliminado correctamente');
        return redirect()->route('cursos.index');
    }
}

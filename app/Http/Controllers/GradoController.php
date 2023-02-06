<?php

namespace App\Http\Controllers;

use App\Models\FacilitadorCentro;
use App\Models\Familia;
use App\Models\Grado;
use App\Models\Persona;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('grados.index');
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

        $grados = Grado::where('grados.nombre', 'like', '%'.$request->filtro.'%')
            ->leftJoin('familias', 'familias.id', '=', 'grados.familia_id')
            ->leftJoin('personas', 'personas.id', '=', 'grados.coordinador_id');
        $total = $grados->count();
        $grados = $grados->offset($offset)->limit($perPage)->select( 'grados.nombre as nombre', 'familias.nombre as familia', 'personas.nombre as coordinador', 'grados.id as url')->get();

        $grados->map(function($grado){
            $grado->url = route('grado.show', $grado->url, false);
            $grado->familia = $grado->familia ? $grado->familia : 'Sin familia';
            $grado->coordinador = $grado->coordinador ? $grado->coordinador : 'Sin coordinador';
        });

        $page = intval($page) > ceil($total / $perPage) ? ceil($total / $perPage) : $page;
        return response([
            'data' => $grados,
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
            'familia' => 'required|numeric|nullable',
            'coordinador' => 'required|numeric|nullable',
        ]);
        $grado = new Grado();
        $grado->nombre = $request->nombre;
        $grado->familia = $request->familia;
        if ($request->coordinador) {
            $coordinador = Persona::findOrFail($request->coordinador);
            if ($coordinador->tipo != 'facilitador_centro') {
                return redirect()->route('grados.index')->withErrors('El coordinador debe ser un facilitador del centro');
            }
            $grado->coordinador = $coordinador->id;
        }
        $grado->save();
        session()->flash('success', 'Grado creado correctamente');
        return redirect()->route('grados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grado = Grado::findOrFail($id);
        $facilitadores = FacilitadorCentro::all();
        $familias = Familia::all();

        return view('grados.show', compact('grado', 'facilitadores', 'familias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function edit(Grado $grado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'familia' => 'integer|nullable',
            'coordinador' => 'integer|nullable',
        ]);
        $grado = Grado::findOrFail($id);
        $grado->nombre = $request->nombre;
        $grado->familia_id = empty($request->familia) ? null : $request->familia;
        $request->coordinador = empty($request->coordinador) ? null : $request->coordinador;

        if($request->coordinador) {
            $coordinador = Persona::findOrFail($request->coordinador);
            if ($coordinador->tipo != 'facilitador_centro') {
                return redirect()->route('grados.index')->withErrors('El coordinador debe ser un facilitador del centro');
            }
            $grado->coordinador_id = $coordinador->id;
        }
        $grado->save();
        session()->flash('success', 'Grado actualizado correctamente');
        return redirect()->route('grado.show', $grado->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grado = Grado::findOrFail($id);
        $grado->delete();
        session()->flash('success', 'Grado eliminado correctamente');
        return redirect()->route('grados.index');
    }
}

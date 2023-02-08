<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('empresa.index');
    }

    public function listado(Request $request)
    {
        $request->validate([
            'page' => 'nullable|integer',
            'filtro' => 'nullable|string',
        ]);

        $page = $request->input('page', 1);
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $empresas = Empresa::where('nombre', 'like', "%{$request->input('filtro')}%");

        $total = $empresas->count();
        $empresas = $empresas->offset($offset)->limit($perPage)
            ->select( 'cif', 'nombre', 'area', 'id as url')
            ->orderBy('nombre', 'asc')
            ->get();

        $empresas->map(function($empresa){
            $empresa->url = route('empresa.show', $empresa->url, false);
        });

        $page = intval($page) > ceil($total / $perPage) ? ceil($total / $perPage) : $page;
        return response([
            'data' => $empresas,
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
        return view('empresa.create');
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
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|min:9|max:9',
            'cif' => 'required|string|min:9|max:9',
            'area' => 'required|string|max:255',
        ]);

        $empresa = new Empresa();
        $empresa->nombre = $request->nombre;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->cif = $request->cif;
        $empresa->area = $request->area;
        $empresa->save();

        return redirect()->route('empresa.show', $empresa->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);

        return view('empresa.show', compact('empresa'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|min:9|max:9',
            'cif' => 'required|string|min:9|max:9',
            'area' => 'required|string|max:255',
        ]);
        $empresa = Empresa::findOrFail($id);
        $empresa->nombre = $request->input('nombre');
        $empresa->direccion = $request->input('direccion');
        $empresa->telefono = $request->input('telefono');
        $empresa->cif = $request->input('cif');
        $empresa->area = $request->input('area');
        $empresa->save();
        session()->flash('message', 'Empresa actualizada correctamente');
        return redirect()->route('empresa.show', $empresa->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}

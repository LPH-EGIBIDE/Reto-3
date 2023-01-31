<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('familias.index');
    }

    public function listado(Request $request)
    {
        $request->validate([
            'page' => 'nullable|integer',
        ]);

        $page = $request->input('page', 1);
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $familias = Familia::offset($offset)->limit($perPage)->select('id', 'nombre')->get();
        $total = Familia::count();

        return response([
            'data' => $familias,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function show(Familia $familia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function edit(Familia $familia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Familia $familia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Familia $familia)
    {
        //
    }
}

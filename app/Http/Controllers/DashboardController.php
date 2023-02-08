<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $persona = auth()->user()->persona;
        return view('dashboard',compact('persona'));
    }
}

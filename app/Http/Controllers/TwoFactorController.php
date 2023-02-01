<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        return view('auth.2fa.step1');
    }

    public function setup(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);
        //Check valid password
        if (!\Hash::check($request->input('password'), $request->user()->password)) {
            return redirect()->route('2fa.enable.step-1')->withErrors([
                'password' => 'La contraseña no es valida'
            ]);
        }
        //Generate a new secret key for the user
        $google2fa = app('pragmarx.google2fa');
        $secretKey = $google2fa->generateSecretKey();
        //Save the secret on session
        $request->session()->flash('google2fa_secret', $secretKey);
        //Generate the QR image
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $request->user()->email,
            $secretKey
        );

        //Return the view with the QR image
        return view('auth.2fa.step2', compact('QR_Image'));

    }

    public function enable(Request $request)
    {
        $request->validate([
            '2fa' => 'required|numeric|digits:6',
        ]);

        //Check if the user has 2fa enabled and the session has the secret
        if ($request->user()->google2fa_secret || !$request->session()->has('google2fa_secret')) {
            return redirect()->route('home');
        }
        $token = $request->session()->get('google2fa_secret');
        //Check if the code is valid
        $google2fa = app('pragmarx.google2fa');
        $valid = $google2fa->verifyKey($token, $request->input('2fa'));
        //Show error if the code is not valid
        if (!$valid) {
            return response([
                'message' => 'Codigo invalido'
            ], 422, [
                'Content-Type' => 'application/json',
            ], JSON_PRETTY_PRINT);
        }
        $request->user()->setGoogle2faSecret($request->input('google2fa_secret'));
        $request->user()->save();
        //Cerrar sesion
        auth()->logout();
        return response([
            'message' => 'Autenticacion en 2 pasos habilitada, se va a cerrar tu sesion'
        ], 200, [
            'Content-Type' => 'application/json',
        ], JSON_PRETTY_PRINT);
    }

    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);
        //Check if the user has 2fa enabled
        if (!$request->user()->google2fa_secret) {
            return redirect()->route('home');
        }
        //check valid password
        if (!\Hash::check($request->input('password'), $request->user()->password)) {
            return redirect()->route('home');
        }
        $request->user()->setGoogle2faSecret(null);
        $request->user()->save();
        return redirect()->route('home');
    }
}

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
        //Check if the user has 2fa enabled and the session has the secret
        if ($request->user()->google2fa_secret || !$request->session()->has('google2fa_secret')) {
            return redirect()->route('index');
        }
        //Gets  the secret from session, and sets it again to the session for validation
        $token = $request->session()->get('google2fa_secret');
        $QR_Image = app('pragmarx.google2fa')->getQRCodeInline(
            config('app.name'),
            $request->user()->email,
            $token
        );
        //Validate the input manually without using validate() method
        //Check if the input is empty or is not a 6 digit number
        if (!$request->filled('2fa') || !preg_match('/^[0-9]{6}$/', $request->input('2fa'))) {
            //Set the session again
            $request->session()->flash('google2fa_secret', $token);
            return view('auth.2fa.step2', compact('QR_Image'))->withErrors([
                '2fa' => 'El codigo es requerido'
            ]);
        }

        //Check if the code is valid
        $google2fa = app('pragmarx.google2fa');
        $valid = $google2fa->verifyKey($token, $request->input('2fa'));
        //Show error if the code is not valid
        if (!$valid) {
            //Set the session again
            $request->session()->flash('google2fa_secret', $token);
            return view('auth.2fa.step2',  compact('QR_Image'))->withErrors([
                '2fa' => 'El codigo introducido no es valido'
            ]);
        }
        $request->user()->setGoogle2faSecret($token);
        $request->user()->save();
        auth()->logout();
        $request->session()->flash('status', 'Verificacion de dos pasos habilitada. Se ha cerrado la sesion. Por favor inicie sesion de nuevo.');
        return redirect()->route('login');
    }

    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);
        //Check if the user has 2fa enabled
        if (!$request->user()->google2fa_secret) {
            return redirect()->route('index');
        }
        //check valid password
        if (!\Hash::check($request->input('password'), $request->user()->password)) {
            return redirect()->route('2fa.disable')->withErrors([
                'password' => 'La contraseña no es valida'
            ]);
        }
        $request->user()->setGoogle2faSecret(null);
        $request->user()->save();
        session()->flash('message', 'Verificacion de dos pasos deshabilitada.');
        return redirect()->route('profile.show');
    }

    public function delete(){
       return view('auth.2fa.disable');
    }
}

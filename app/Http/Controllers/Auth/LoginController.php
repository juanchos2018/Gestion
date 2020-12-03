<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function FrmLogin()
    {
        return view('auth.login');
    }

    public function Login(Request $request)
    {
        $this->validate(request(), [
            'TxtCorreo' => 'email|required|string',
            'TxtClave' => 'required|string'
        ]);

        $credentials = [
            'Correo' => $request->TxtCorreo,
            'password' => $request->TxtClave
        ];

        if(Auth::attempt($credentials))
        {
            return redirect()->intended('dashboard');
        }

        return back()->withInput(request(['TxtCorreo']));
    }

    public function Logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //Muestra la vista que contiene el formulario de registro para crear un usuario
    public function showRegister()
    {
        return view('auth.register');
    }

    //Muestra la vista que contiene el formulario para ingresar las credenciales e iniciar sesi[on]
    public function showLogin()
    {
        return view('auth.login');
    }

    //Registra un nuevo usuario en la base de datos
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        
        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    //Inicia sesión en la aplicación
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if(Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        throw ValidationException::withMessages([
            'credentials' => 'Las credenciales proporcionadas son incorrectas.',
        ]);
    }

    //Cierra la sesión del usuario
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}

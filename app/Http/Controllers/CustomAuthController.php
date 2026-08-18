<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Si es visitante y está pendiente, no puede entrar
            if ($user->role === 'visitante' && $user->estado !== 'aprobado') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Tu solicitud está pendiente de aprobación o ha sido rechazada.',
                ]);
            }

            // Si es visitante y ha expirado
            if ($user->role === 'visitante' && $user->isExpired()) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Tu tiempo de acceso ha expirado.',
                ]);
            }

            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Registro de visitantes
    public function showRegisterVisitante()
    {
        return view('auth.register-visitante');
    }

    public function registerVisitante(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('visitante123'),
            'role' => 'visitante',
            'estado' => 'pendiente', // 👈 ESTADO PENDIENTE
        ]);

        return redirect()->route('login')->with('success', '✅ Registro exitoso. Espera la aprobación de la jefa.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        $pendientes = User::where('estado', 'pendiente')->where('role', 'visitante')->get();
        return view('admin.index', compact('usuarios', 'pendientes'));
    }

    public function createAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'estado' => 'aprobado',
        ]);

        return redirect()->route('admin.index')->with('success', '✅ Administrador creado.');
    }

    public function aprobarVisitante(Request $request, $id)
    {
        $request->validate([
            'horas' => 'required|in:1,2',
        ]);

        $user = User::findOrFail($id);
        $user->estado = 'aprobado';
        $user->expires_at = now()->addHours($request->horas);
        $user->save();

        return redirect()->route('admin.index')->with('success', "✅ Visitante aprobado por {$request->horas} hora(s).");
    }

    public function rechazarVisitante($id)
    {
        $user = User::findOrFail($id);
        $user->estado = 'rechazado';
        $user->save();

        return redirect()->route('admin.index')->with('success', '❌ Visitante rechazado.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'jefa') {
            return redirect()->route('admin.index')->with('error', '❌ No puedes eliminar a la jefa.');
        }

        $user->delete();
        return redirect()->route('admin.index')->with('success', '✅ Usuario eliminado.');
    }

    public function comentarios()
    {
        $comentarios = Comentario::with(['user', 'instrumento'])
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('admin.comentarios', compact('comentarios'));
    }

    public function marcarLeido($id)
    {
        $comentario = Comentario::findOrFail($id);
        $comentario->leido = true;
        $comentario->save();
        return redirect()->route('admin.comentarios')->with('success', '✅ Comentario marcado como leído.');
    }
}
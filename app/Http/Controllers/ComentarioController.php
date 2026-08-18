<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Instrumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'instrumento_id' => 'required|exists:instrumentos,id',
            'comentario' => 'required|min:3',
        ]);

        Comentario::create([
            'user_id' => Auth::id(),
            'instrumento_id' => $request->instrumento_id,
            'comentario' => $request->comentario,
            'leido' => false,
        ]);

        return back()->with('success', '✅ Comentario enviado. La jefa lo revisará.');
    }
}
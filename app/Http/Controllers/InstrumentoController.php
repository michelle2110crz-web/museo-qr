<?php

namespace App\Http\Controllers;

use App\Models\Instrumento;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InstrumentoController extends Controller
{
    public function index()
    {
        $instrumentos = Instrumento::all();
        return view('instrumentos.index', compact('instrumentos'));
    }

    public function create()
    {
        return view('instrumentos.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . str_replace(' ', '_', $imagen->getClientOriginalName());
            $imagen->move(public_path('storage/instrumentos'), $nombreImagen);
            $data['imagen'] = 'storage/instrumentos/' . $nombreImagen;
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $nombreVideo = time() . '_' . str_replace(' ', '_', $video->getClientOriginalName());
            $video->move(public_path('storage/instrumentos'), $nombreVideo);
            $data['video'] = 'storage/instrumentos/' . $nombreVideo;
        }

        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $nombreAudio = time() . '_' . str_replace(' ', '_', $audio->getClientOriginalName());
            $audio->move(public_path('storage/instrumentos'), $nombreAudio);
            $data['audio'] = 'storage/instrumentos/' . $nombreAudio;
        }

        Instrumento::create($data);
        return redirect()->route('instrumentos.index')->with('success', 'Instrumento creado');
    }

    public function show($id)
    {
        $instrumento = Instrumento::findOrFail($id);
        return view('instrumentos.show', compact('instrumento'));
    }

    public function edit($id)
    {
        $instrumento = Instrumento::findOrFail($id);
        return view('instrumentos.edit', compact('instrumento'));
    }

    public function update(Request $request, $id)
    {
        $instrumento = Instrumento::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('imagen')) {
            if ($instrumento->imagen && file_exists(public_path($instrumento->imagen))) {
                unlink(public_path($instrumento->imagen));
            }
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . str_replace(' ', '_', $imagen->getClientOriginalName());
            $imagen->move(public_path('storage/instrumentos'), $nombreImagen);
            $data['imagen'] = 'storage/instrumentos/' . $nombreImagen;
        }

        if ($request->hasFile('video')) {
            if ($instrumento->video && file_exists(public_path($instrumento->video))) {
                unlink(public_path($instrumento->video));
            }
            $video = $request->file('video');
            $nombreVideo = time() . '_' . str_replace(' ', '_', $video->getClientOriginalName());
            $video->move(public_path('storage/instrumentos'), $nombreVideo);
            $data['video'] = 'storage/instrumentos/' . $nombreVideo;
        }

        if ($request->hasFile('audio')) {
            if ($instrumento->audio && file_exists(public_path($instrumento->audio))) {
                unlink(public_path($instrumento->audio));
            }
            $audio = $request->file('audio');
            $nombreAudio = time() . '_' . str_replace(' ', '_', $audio->getClientOriginalName());
            $audio->move(public_path('storage/instrumentos'), $nombreAudio);
            $data['audio'] = 'storage/instrumentos/' . $nombreAudio;
        }

        $instrumento->update($data);
        return redirect()->route('instrumentos.index')->with('success', 'Instrumento actualizado');
    }

    public function destroy($id)
    {
        $instrumento = Instrumento::findOrFail($id);

        if ($instrumento->imagen && file_exists(public_path($instrumento->imagen))) {
            unlink(public_path($instrumento->imagen));
        }
        if ($instrumento->video && file_exists(public_path($instrumento->video))) {
            unlink(public_path($instrumento->video));
        }
        if ($instrumento->audio && file_exists(public_path($instrumento->audio))) {
            unlink(public_path($instrumento->audio));
        }

        $instrumento->delete();
        return redirect()->route('instrumentos.index')->with('success', 'Instrumento eliminado');
    }

    public function showQrLista()
    {
        $qrCode = QrCode::size(300)->generate(route('instrumentos.index'));
        $instrumentos = Instrumento::take(50)->get();
        return view('instrumentos.qr_lista', compact('qrCode', 'instrumentos'));
    }

    public function visitaVirtual()
    {
        $instrumentos = Instrumento::where('tiene_visita_virtual', true)->take(5)->get();
        return view('instrumentos.visita_virtual', compact('instrumentos'));
    }
}
@extends('layouts.app')

@section('title', 'Editar ' . $instrumento->nombre)

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="card-glass p-6 md:p-8">
        <h1 class="font-display text-3xl text-[#c49a6c] text-center">✏️ Editar Instrumento</h1>
        <hr class="border-[#2a2a2a] my-6">

        <form action="{{ route('instrumentos.update', $instrumento->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-[#c49a6c] font-semibold text-sm">Nombre *</label>
                <input type="text" name="nombre" value="{{ $instrumento->nombre }}" class="input-dark" required>
            </div>

            <div class="mb-4">
                <label class="block text-[#c49a6c] font-semibold text-sm">Nombre Original</label>
                <input type="text" name="nombre_original" value="{{ $instrumento->nombre_original }}" class="input-dark">
            </div>

            <div class="mb-4">
                <label class="block text-[#c49a6c] font-semibold text-sm">Familia *</label>
                <input type="text" name="familia" value="{{ $instrumento->familia }}" class="input-dark" required>
            </div>

            <div class="mb-4">
                <label class="block text-[#c49a6c] font-semibold text-sm">Origen *</label>
                <input type="text" name="origen" value="{{ $instrumento->origen }}" class="input-dark" required>
            </div>

            <div class="mb-4">
                <label class="block text-[#c49a6c] font-semibold text-sm">Historia *</label>
                <textarea name="historia" rows="3" class="input-dark" required>{{ $instrumento->historia }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-[#c49a6c] font-semibold text-sm">Características</label>
                <textarea name="caracteristicas" rows="2" class="input-dark">{{ $instrumento->caracteristicas }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-[#c49a6c] font-semibold text-sm">Uso Cultural</label>
                <textarea name="uso_cultural" rows="2" class="input-dark">{{ $instrumento->uso_cultural }}</textarea>
            </div>

            @if($instrumento->imagen)
                <div class="mb-4">
                    <label class="block text-[#c49a6c] font-semibold text-sm">📷 Imagen actual</label>
                    <img src="{{ asset($instrumento->imagen) }}" alt="{{ $instrumento->nombre }}" class="max-h-32 rounded-lg border border-[#2a2a2a]">
                </div>
            @endif

            <div class="mb-4">
                <label class="block text-[#c49a6c] font-semibold text-sm">📷 Cambiar imagen</label>
                <input type="file" name="imagen" class="input-dark file:bg-[#c49a6c] file:text-[#0a0a0f] file:font-bold file:border-0 file:rounded-lg file:px-4 file:py-2">
            </div>

            @if($instrumento->video)
                <div class="mb-4">
                    <label class="block text-[#c49a6c] font-semibold text-sm">🎬 Video actual</label>
                    <video controls class="max-h-32 rounded-lg border border-[#2a2a2a]">
                        <source src="{{ asset($instrumento->video) }}" type="video/mp4">
                    </video>
                </div>
            @endif

            <div class="mb-4">
                <label class="block text-[#c49a6c] font-semibold text-sm">🎬 Cambiar video</label>
                <input type="file" name="video" class="input-dark file:bg-[#c49a6c] file:text-[#0a0a0f] file:font-bold file:border-0 file:rounded-lg file:px-4 file:py-2">
            </div>

            @if($instrumento->audio)
                <div class="mb-4">
                    <label class="block text-[#c49a6c] font-semibold text-sm">🎧 Audio actual</label>
                    <audio controls class="w-full max-w-md">
                        <source src="{{ asset($instrumento->audio) }}" type="audio/mpeg">
                    </audio>
                </div>
            @endif

            <div class="mb-4">
                <label class="block text-[#c49a6c] font-semibold text-sm">🎧 Cambiar audio</label>
                <input type="file" name="audio" class="input-dark file:bg-[#c49a6c] file:text-[#0a0a0f] file:font-bold file:border-0 file:rounded-lg file:px-4 file:py-2">
            </div>

            <div class="mb-6 flex items-center gap-3">
                <input type="checkbox" name="tiene_visita_virtual" value="1" id="virtual" {{ $instrumento->tiene_visita_virtual ? 'checked' : '' }} class="accent-[#c49a6c] w-5 h-5">
                <label for="virtual" class="text-[#c49a6c] font-semibold text-sm">📱 Tiene visita virtual</label>
            </div>

            <div class="flex flex-wrap gap-4">
                <button type="submit" class="btn-glow inline-block">💾 Actualizar</button>
                <a href="{{ route('instrumentos.index') }}" class="btn-outline-glow inline-block">← Volver</a>
            </div>
        </form>
    </div>
</div>

<style>
    .btn-glow {
        background: linear-gradient(135deg, #c49a6c, #a87d5a);
        color: #0a0a0f;
        font-weight: 700;
        padding: 12px 32px;
        border-radius: 50px;
        transition: all 0.4s ease;
        text-decoration: none;
        display: inline-block;
        border: none;
        cursor: pointer;
    }
    .btn-glow:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 40px rgba(196,154,108,0.2);
        background: linear-gradient(135deg, #d4aa7c, #b88d6a);
    }
    .btn-outline-glow {
        background: transparent;
        color: #c49a6c;
        font-weight: 600;
        padding: 12px 32px;
        border-radius: 50px;
        border: 1px solid rgba(196,154,108,0.25);
        transition: all 0.4s ease;
        text-decoration: none;
        display: inline-block;
    }
    .btn-outline-glow:hover {
        background: rgba(196,154,108,0.08);
        border-color: #c49a6c;
        box-shadow: 0 0 40px rgba(196,154,108,0.08);
        transform: translateY(-2px);
        color: #c49a6c;
    }
</style>
@endsection
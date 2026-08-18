@extends('layouts.app')

@section('title', $instrumento->nombre)

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <div class="card-glass p-6 md:p-8">
        <h1 class="font-display text-3xl text-[#c49a6c]">🎵 {{ $instrumento->nombre }}</h1>
        @if($instrumento->nombre_original)
            <p class="text-[#888] mt-1"><span class="text-[#666]">Original:</span> {{ $instrumento->nombre_original }}</p>
        @endif
        <div class="grid grid-cols-2 gap-2 mt-4 text-[#aaa]">
            <p><span class="text-[#666]">Familia:</span> {{ $instrumento->familia }}</p>
            <p><span class="text-[#666]">Origen:</span> {{ $instrumento->origen }}</p>
        </div>

        @if($instrumento->imagen)
            <div class="my-6">
                <img src="{{ asset($instrumento->imagen) }}" alt="{{ $instrumento->nombre }}" class="rounded-xl max-h-80 w-auto mx-auto border border-[#2a2a2a]">
            </div>
        @endif

        @if($instrumento->video)
            <div class="my-6">
                <h5 class="font-bold text-[#c49a6c] mb-2">🎬 Video</h5>
                <video controls class="w-full rounded-xl border border-[#2a2a2a]">
                    <source src="{{ asset($instrumento->video) }}" type="video/mp4">
                    Tu navegador no soporta video.
                </video>
            </div>
        @endif

        @if($instrumento->audio)
            <div class="my-6">
                <h5 class="font-bold text-[#c49a6c] mb-2">🎧 Escucha el instrumento</h5>
                <audio controls class="w-full max-w-md bg-[#0a0a0f] rounded-lg p-2 border border-[#2a2a2a]">
                    <source src="{{ asset($instrumento->audio) }}" type="audio/mpeg">
                </audio>
            </div>
        @endif

        <hr class="border-[#2a2a2a] my-6">

        <h5 class="font-bold text-[#c49a6c]">📖 Historia</h5>
        <p class="text-[#bbb] leading-relaxed">{{ $instrumento->historia }}</p>

        @if($instrumento->caracteristicas)
            <h5 class="font-bold text-[#c49a6c] mt-4">🔧 Características</h5>
            <p class="text-[#bbb]">{{ $instrumento->caracteristicas }}</p>
        @endif

        @if($instrumento->uso_cultural)
            <h5 class="font-bold text-[#c49a6c] mt-4">🎭 Uso Cultural</h5>
            <p class="text-[#bbb]">{{ $instrumento->uso_cultural }}</p>
        @endif

        <!-- COMENTARIOS - SOLO PARA VISITANTES -->
        @auth
            @if(Auth::user()->isVisitante())
                <div class="mt-6 p-4 bg-[#1a1a2e] rounded-xl border border-[#2a2a2a]">
                    <h5 class="font-bold text-[#c49a6c] mb-3">💬 Deja tu comentario</h5>
                    <form method="POST" action="{{ route('comentarios.store') }}">
                        @csrf
                        <input type="hidden" name="instrumento_id" value="{{ $instrumento->id }}">
                        <textarea name="comentario" rows="3" class="input-dark" placeholder="Escribe tu comentario sobre este instrumento..." required></textarea>
                        <button type="submit" class="btn-glow mt-2 inline-block">Enviar Comentario</button>
                    </form>
                    @if(session('success'))
                        <p class="text-green-400 text-sm mt-2">{{ session('success') }}</p>
                    @endif
                </div>
            @endif
        @endauth

        <div class="mt-8 flex flex-wrap gap-4">
            @if(Auth::check() && (Auth::user()->isJefa() || Auth::user()->isAdmin()))
                <a href="{{ route('instrumentos.edit', $instrumento->id) }}" class="bg-[#c49a6c] text-[#1a1a2e] px-6 py-2 rounded-full font-bold hover:bg-[#d4aa7c] transition">✏️ Editar</a>
            @endif
            <a href="{{ route('instrumentos.index') }}" class="border border-white/30 text-white px-6 py-2 rounded-full font-semibold hover:bg-white/10 transition">← Volver</a>
        </div>
    </div>
</div>

<style>
    .btn-glow {
        background: linear-gradient(135deg, #c49a6c, #a87d5a);
        color: #0a0a0f;
        font-weight: 700;
        padding: 10px 28px;
        border-radius: 50px;
        transition: all 0.4s ease;
        text-decoration: none;
        display: inline-block;
        font-size: 0.85rem;
        border: none;
        cursor: pointer;
    }
    .btn-glow:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 40px rgba(196,154,108,0.2);
        background: linear-gradient(135deg, #d4aa7c, #b88d6a);
    }
    .input-dark {
        background: rgba(10, 10, 15, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 12px;
        padding: 12px 16px;
        color: #e0e0e0;
        transition: all 0.3s ease;
        width: 100%;
    }
    .input-dark:focus {
        outline: none;
        border-color: #c49a6c;
        box-shadow: 0 0 20px rgba(196, 154, 108, 0.06);
    }
</style>
@endsection
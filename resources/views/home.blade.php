@extends('layouts.app')

@section('title', 'Museo de Instrumentos Musicales')

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-cover bg-center bg-fixed"
     style="background-image: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.85)), url('{{ asset('images/fondo.jpg') }}'); background-size: cover; background-position: center;">
    <div class="text-center px-4 max-w-4xl animate-fadeInUp">
        <span class="inline-block bg-[#c49a6c]/10 text-[#c49a6c] border border-[#c49a6c]/20 px-6 py-2 rounded-full text-xs font-bold tracking-[0.2em] uppercase mb-6">
            🏛️ Patrimonio Cultural
        </span>
        <h1 class="font-display text-5xl md:text-7xl font-bold leading-tight text-white drop-shadow-2xl">
            Museo de Instrumentos Musicales
        </h1>
        <p class="text-xl md:text-2xl font-light tracking-[0.3em] text-[#c4b5a0] mt-2">
            "Ernesto Cavour Aramayo"
        </p>
        <p class="text-[#888] mt-4 tracking-wide">📍 Calle Apolinar Jaén N° 711 · La Paz · Bolivia</p>
        <p class="text-lg font-light max-w-2xl mx-auto mt-6 leading-relaxed text-[#aaa]">
            Descubre la historia, el sonido y el alma de instrumentos de todo el mundo.
        </p>
        <div class="mt-10 flex flex-wrap gap-4 justify-center">
            <a href="{{ route('instrumentos.index') }}" class="btn-glow inline-block">
                Explorar Colección
            </a>
            <a href="{{ route('visita.virtual') }}" class="btn-outline-glow inline-block">
                👁️ Visita Virtual
            </a>
        </div>
    </div>
</div>

<style>
    .btn-glow {
        background: linear-gradient(135deg, #c49a6c, #a87d5a);
        color: #0a0a0f;
        font-weight: 700;
        padding: 14px 40px;
        border-radius: 50px;
        transition: all 0.4s ease;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 0.85rem;
        box-shadow: 0 0 30px rgba(196,154,108,0.1);
        text-decoration: none;
        display: inline-block;
    }
    .btn-glow:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 0 50px rgba(196,154,108,0.25);
        background: linear-gradient(135deg, #d4aa7c, #b88d6a);
        color: #0a0a0f;
    }
    .btn-outline-glow {
        background: transparent;
        color: #c49a6c;
        font-weight: 600;
        padding: 14px 40px;
        border-radius: 50px;
        border: 1px solid rgba(196,154,108,0.25);
        transition: all 0.4s ease;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-block;
    }
    .btn-outline-glow:hover {
        background: rgba(196,154,108,0.08);
        border-color: #c49a6c;
        box-shadow: 0 0 40px rgba(196,154,108,0.08);
        transform: translateY(-3px);
        color: #c49a6c;
    }
</style>
@endsection
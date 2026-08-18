@extends('layouts.app')

@section('title', 'Visita Virtual Limitada')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="card-glass p-6 mb-8 border-l-4 border-[#c49a6c]">
        <div class="flex flex-wrap items-center justify-between">
            <div>
                <h2 class="font-display text-2xl text-[#c49a6c]">🎟️ ¿Quieres ver más?</h2>
                <p class="text-[#888]">Esta es una visita virtual limitada con imágenes en baja resolución.</p>
                <p class="text-[#888]">Para acceder a la historia completa y el sonido real, <strong class="text-[#c49a6c]">¡visítanos en el museo!</strong></p>
            </div>
            <a href="{{ route('instrumentos.index') }}" class="btn-glow mt-4 md:mt-0">
                Ver colección completa
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($instrumentos as $instrumento)
        <div class="card-glass overflow-hidden hover:border-[#c49a6c]/30 transition">
            <div class="relative">
                @if($instrumento->imagen)
                    <img src="{{ asset($instrumento->imagen) }}" alt="{{ $instrumento->nombre }}" class="w-full h-48 object-cover filter blur-sm brightness-75">
                @else
                    <div class="w-full h-48 bg-[#1a1a1a] flex items-center justify-center text-[#555]">🎵</div>
                @endif
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="bg-black/60 text-white px-4 py-2 rounded-lg text-center border border-white/20 backdrop-blur-sm">
                        <span class="text-2xl block">🔒</span>
                        <span class="text-xs uppercase tracking-wider">Visita el museo</span>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-bold text-white">{{ $instrumento->nombre }}</h3>
                <p class="text-[#888] text-sm">{{ $instrumento->familia }} · {{ $instrumento->origen }}</p>
                <p class="text-[#666] text-sm mt-2 line-clamp-2">{{ Str::limit($instrumento->historia, 80) }}</p>
                <div class="mt-4">
                    <span class="bg-[#c49a6c]/20 text-[#c49a6c] text-xs px-3 py-1 rounded-full">📱 Virtual</span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-[#555]">
            <p>No hay instrumentos disponibles para la visita virtual.</p>
            <p class="text-sm">Marca la casilla "Tiene visita virtual" al crear un instrumento.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    .btn-glow {
        background: linear-gradient(135deg, #c49a6c, #a87d5a);
        color: #0a0a0f;
        font-weight: 700;
        padding: 12px 28px;
        border-radius: 50px;
        transition: all 0.4s ease;
        text-decoration: none;
        display: inline-block;
        font-size: 0.85rem;
    }
    .btn-glow:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 40px rgba(196,154,108,0.2);
        background: linear-gradient(135deg, #d4aa7c, #b88d6a);
    }
</style>
@endsection
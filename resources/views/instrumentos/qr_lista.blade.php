@extends('layouts.app')

@section('title', 'QR - Lista de Instrumentos')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="card-glass p-6 md:p-8">
        <h1 class="font-display text-3xl text-[#c49a6c] text-center">🔲 Escanea para ver la colección</h1>
        <p class="text-[#888] text-center">Este QR muestra todos los instrumentos del museo</p>

        <div class="flex flex-col md:flex-row items-center gap-8 mt-6">
            <div class="bg-white p-4 rounded-xl inline-block mx-auto md:mx-0">
                {!! $qrCode !!}
            </div>

            <div class="w-full">
                <h3 class="text-[#c49a6c] font-bold mb-3">📋 Instrumentos disponibles ({{ $instrumentos->count() }})</h3>
                <div class="max-h-60 overflow-y-auto bg-[#0a0a0f] rounded-xl p-3 border border-[#1a1a1a]">
                    @foreach($instrumentos as $i)
                        <div class="flex justify-between items-center border-b border-[#1a1a1a] py-2">
                            <span class="text-white">{{ $i->nombre }}</span>
                            <span class="text-[#666] text-sm">{{ $i->familia }}</span>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('instrumentos.index') }}" class="btn-glow inline-block w-full text-center mt-4">
                    Ver colección completa
                </a>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('instrumentos.index') }}" class="text-[#666] hover:text-[#c49a6c] transition text-sm">← Volver</a>
        </div>
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
        font-size: 0.85rem;
    }
    .btn-glow:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 40px rgba(196,154,108,0.2);
        background: linear-gradient(135deg, #d4aa7c, #b88d6a);
    }
</style>
@endsection
@extends('layouts.app')

@section('title', 'Comentarios de Visitantes')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="font-display text-3xl text-[#c49a6c] text-center">💬 Comentarios de Visitantes</h1>
    <p class="text-[#888] text-center mb-8">Comentarios enviados por los visitantes del museo</p>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-glass p-6">
        @forelse($comentarios as $comentario)
        <div class="border-b border-[#1a1a1a] py-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-white font-semibold">{{ $comentario->user->name }}</p>
                    <p class="text-[#888] text-sm">{{ $comentario->user->email }}</p>
                    <p class="text-[#999] mt-1">{{ $comentario->comentario }}</p>
                    <p class="text-[#666] text-xs mt-1">Instrumento: <span class="text-[#c49a6c]">{{ $comentario->instrumento->nombre }}</span></p>
                </div>
                <div class="flex gap-2 flex-wrap">
                    <span class="text-xs {{ $comentario->leido ? 'text-green-400' : 'text-yellow-400' }}">
                        {{ $comentario->leido ? '✅ Leído' : '🟡 No leído' }}
                    </span>
                    @if(!$comentario->leido)
                        <form method="POST" action="{{ route('admin.marcar-leido', $comentario->id) }}">
                            @csrf
                            <button type="submit" class="text-[#c49a6c] hover:text-[#d4aa7c] text-sm">Marcar como leído</button>
                        </form>
                    @endif
                </div>
            </div>
            <p class="text-[#555] text-xs mt-2">{{ $comentario->created_at->format('d/m/Y H:i') }}</p>
        </div>
        @empty
        <p class="text-center text-[#555] py-8">No hay comentarios nuevos.</p>
        @endforelse
    </div>

    <div class="text-center mt-6">
        <a href="{{ route('admin.index') }}" class="text-[#666] hover:text-[#c49a6c] transition">← Volver al panel</a>
    </div>
</div>
@endsection
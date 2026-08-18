@extends('layouts.app')

@section('title', 'Instrumentos del Museo')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <h1 class="font-display text-3xl text-[#c49a6c]">🎵 Instrumentos del Mundo</h1>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('qr.lista') }}" class="bg-transparent text-[#c49a6c] font-semibold px-4 py-2 rounded-full border border-[#c49a6c]/30 hover:bg-[#c49a6c]/10 transition text-sm">
                🔲 QR General
            </a>
            @if(Auth::check() && (Auth::user()->isJefa() || Auth::user()->isAdmin()))
                <a href="{{ route('instrumentos.create') }}" class="bg-[#c49a6c] text-[#0a0a0a] font-bold px-4 py-2 rounded-full hover:bg-[#d4aa7c] transition text-sm">
                    + Nuevo
                </a>
            @endif
        </div>
    </div>

    <div class="bg-[#1e1e2e] rounded-xl overflow-hidden border border-[#2a2a2a]">
        <table class="w-full text-left text-[#ddd]">
            <thead class="bg-[#1a1a2e] border-b border-[#c49a6c]/30">
                <tr>
                    <th class="px-4 py-3 text-[#c49a6c] text-sm">#</th>
                    <th class="px-4 py-3 text-[#c49a6c] text-sm">Instrumento</th>
                    <th class="px-4 py-3 text-[#c49a6c] text-sm">Familia</th>
                    <th class="px-4 py-3 text-[#c49a6c] text-sm">Origen</th>
                    <th class="px-4 py-3 text-[#c49a6c] text-sm">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($instrumentos as $instrumento)
                <tr class="border-b border-[#1a1a1a] hover:bg-[#12121e] transition">
                    <td class="px-4 py-3 text-[#888]">{{ $instrumento->id }}</td>
                    <td class="px-4 py-3 font-medium text-white">{{ $instrumento->nombre }}</td>
                    <td class="px-4 py-3 text-[#aaa]">{{ $instrumento->familia }}</td>
                    <td class="px-4 py-3 text-[#aaa]">{{ $instrumento->origen }}</td>
                    <td class="px-4 py-3 flex flex-wrap gap-3">
                        <a href="{{ route('instrumentos.show', $instrumento->id) }}" class="text-blue-400 hover:text-blue-300 text-sm">Ver</a>

                        @if(Auth::check() && (Auth::user()->isJefa() || Auth::user()->isAdmin()))
                            <a href="{{ route('instrumentos.edit', $instrumento->id) }}" class="text-yellow-400 hover:text-yellow-300 text-sm">Editar</a>
                        @endif

                        @if(Auth::check() && Auth::user()->isJefa())
                            <form action="{{ route('instrumentos.destroy', $instrumento->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 text-sm" onclick="return confirm('¿Eliminar este instrumento?')">Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-[#555]">No hay instrumentos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
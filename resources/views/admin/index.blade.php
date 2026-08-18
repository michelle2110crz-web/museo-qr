@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="font-display text-3xl text-[#c49a6c] text-center">👑 Panel de Administración</h1>
    <p class="text-[#888] text-center mb-8">Bienvenida, <strong class="text-[#c49a6c]">{{ Auth::user()->name }}</strong></p>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- SOLICITUDES PENDIENTES -->
    @if($pendientes->count() > 0)
    <div class="card-glass p-6 mb-8 border-l-4 border-yellow-500">
        <h2 class="font-display text-xl text-yellow-400 mb-4">🟡 Solicitudes Pendientes</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-[#ddd]">
                <thead class="border-b border-[#c49a6c]/10">
                    <tr>
                        <th class="py-2 text-yellow-400">Nombre</th>
                        <th class="py-2 text-yellow-400">Email</th>
                        <th class="py-2 text-yellow-400">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendientes as $user)
                    <tr class="border-b border-[#1a1a1a]">
                        <td class="py-2">{{ $user->name }}</td>
                        <td class="py-2">{{ $user->email }}</td>
                        <td class="py-2 flex flex-wrap gap-2">
                            <form method="POST" action="{{ route('admin.aprobar', $user->id) }}" class="inline">
                                @csrf
                                <select name="horas" class="input-dark inline w-24 text-sm">
                                    <option value="1">1 hora</option>
                                    <option value="2">2 horas</option>
                                </select>
                                <button type="submit" class="bg-green-500/20 text-green-400 px-3 py-1 rounded-lg hover:bg-green-500/30 transition text-sm">✅ Aprobar</button>
                            </form>
                            <form method="POST" action="{{ route('admin.rechazar', $user->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500/20 text-red-400 px-3 py-1 rounded-lg hover:bg-red-500/30 transition text-sm">❌ Rechazar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Crear Administrador -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="card-glass p-6">
            <h2 class="font-display text-xl text-[#c49a6c] mb-4">➕ Crear Administrador</h2>
            <form method="POST" action="{{ route('admin.create-admin') }}">
                @csrf
                <div class="mb-3">
                    <label class="block text-[#888] text-sm">Nombre</label>
                    <input type="text" name="name" class="input-dark" required>
                </div>
                <div class="mb-3">
                    <label class="block text-[#888] text-sm">Email</label>
                    <input type="email" name="email" class="input-dark" required>
                </div>
                <div class="mb-3">
                    <label class="block text-[#888] text-sm">Contraseña</label>
                    <input type="password" name="password" class="input-dark" required>
                </div>
                <button type="submit" class="btn-glow w-full">Crear Administrador</button>
            </form>
        </div>

        <div class="card-glass p-6">
            <h2 class="font-display text-xl text-[#c49a6c] mb-4">👤 Información</h2>
            <p class="text-[#666] text-sm">Los visitantes se registran solos y tú los apruebas desde la sección de solicitudes.</p>
            <a href="{{ route('register.visitante') }}" class="btn-glow w-full text-center inline-block mt-4">Ver formulario de registro</a>
        </div>
    </div>

    <!-- Lista de Usuarios -->
    <div class="card-glass p-6">
        <h2 class="font-display text-xl text-[#c49a6c] mb-4">📋 Usuarios del Sistema</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-[#ddd]">
                <thead class="border-b border-[#c49a6c]/10">
                    <tr>
                        <th class="py-2 text-[#c49a6c]">Nombre</th>
                        <th class="py-2 text-[#c49a6c]">Email</th>
                        <th class="py-2 text-[#c49a6c]">Rol</th>
                        <th class="py-2 text-[#c49a6c]">Estado</th>
                        <th class="py-2 text-[#c49a6c]">Expira</th>
                        <th class="py-2 text-[#c49a6c]">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                    <tr class="border-b border-[#1a1a1a]">
                        <td class="py-2">{{ $user->name }}</td>
                        <td class="py-2">{{ $user->email }}</td>
                        <td class="py-2">
                            <span class="px-2 py-1 rounded-full text-xs
                                {{ $user->role === 'jefa' ? 'bg-[#c49a6c] text-[#0a0a0f] font-bold' : '' }}
                                {{ $user->role === 'admin' ? 'bg-blue-500/20 text-blue-400' : '' }}
                                {{ $user->role === 'visitante' ? 'bg-green-500/20 text-green-400' : '' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="py-2">
                            @if($user->role === 'visitante')
                                <span class="px-2 py-1 rounded-full text-xs
                                    {{ $user->estado === 'aprobado' ? 'bg-green-500/20 text-green-400' : '' }}
                                    {{ $user->estado === 'pendiente' ? 'bg-yellow-500/20 text-yellow-400' : '' }}
                                    {{ $user->estado === 'rechazado' ? 'bg-red-500/20 text-red-400' : '' }}">
                                    {{ ucfirst($user->estado) }}
                                </span>
                            @else
                                <span class="text-[#555]">—</span>
                            @endif
                        </td>
                        <td class="py-2">
                            @if($user->expires_at)
                                {{ \Carbon\Carbon::parse($user->expires_at)->format('d/m/Y H:i') }}
                            @else
                                ∞
                            @endif
                        </td>
                        <td class="py-2">
                            @if($user->id !== Auth::id())
                                <form method="POST" action="{{ route('admin.destroy-user', $user->id) }}" onsubmit="return confirm('¿Eliminar este usuario?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 text-sm">Eliminar</button>
                                </form>
                            @else
                                <span class="text-[#555] text-xs">(Tú)</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Ver comentarios -->
    <div class="mt-6 text-center">
        <a href="{{ route('admin.comentarios') }}" class="btn-glow inline-block">💬 Ver Comentarios</a>
    </div>
</div>
@endsection
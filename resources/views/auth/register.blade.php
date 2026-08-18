<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - Museo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0f0f1a; color: #e0e0e0; }
        .font-display { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-[#1e1e2e] rounded-xl p-8 border border-[#2a2a2a] max-w-md w-full">
            <h1 class="font-display text-3xl text-[#c49a6c] text-center">🎵 Museo</h1>
            <p class="text-[#888] text-center mb-6">Crea una cuenta</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-[#c49a6c] font-semibold text-sm">Nombre</label>
                    <input type="text" name="name" class="w-full bg-[#2a2a2a] border border-[#3a3a3a] rounded-lg px-4 py-2 text-white focus:border-[#c49a6c] outline-none" required>
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-[#c49a6c] font-semibold text-sm">Email</label>
                    <input type="email" name="email" class="w-full bg-[#2a2a2a] border border-[#3a3a3a] rounded-lg px-4 py-2 text-white focus:border-[#c49a6c] outline-none" required>
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-[#c49a6c] font-semibold text-sm">Contraseña</label>
                    <input type="password" name="password" class="w-full bg-[#2a2a2a] border border-[#3a3a3a] rounded-lg px-4 py-2 text-white focus:border-[#c49a6c] outline-none" required>
                    @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-[#c49a6c] font-semibold text-sm">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" class="w-full bg-[#2a2a2a] border border-[#3a3a3a] rounded-lg px-4 py-2 text-white focus:border-[#c49a6c] outline-none" required>
                </div>

                <button type="submit" class="w-full bg-[#c49a6c] text-[#1a1a2e] font-bold py-2 rounded-lg hover:bg-[#d4aa7c] transition">
                    Registrarse
                </button>
            </form>

            <p class="text-center text-[#666] text-sm mt-4">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-[#c49a6c] hover:text-[#d4aa7c]">Inicia Sesión</a>
            </p>
        </div>
    </div>
</body>
</html>
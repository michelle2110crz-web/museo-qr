<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Visitante</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0a0a0f; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .font-display { font-family: 'Playfair Display', serif; }
        .card-glass { background: rgba(20,20,30,0.8); backdrop-filter: blur(12px); border: 1px solid rgba(196,154,108,0.08); border-radius: 24px; box-shadow: 0 8px 40px rgba(0,0,0,0.6); }
        .input-dark { background: rgba(10,10,15,0.6); border: 1px solid rgba(255,255,255,0.06); border-radius: 12px; padding: 12px 16px; color: #e0e0e0; transition: all 0.3s ease; width: 100%; }
        .input-dark:focus { outline: none; border-color: #c49a6c; box-shadow: 0 0 20px rgba(196,154,108,0.06); }
        .btn-glow { background: linear-gradient(135deg, #c49a6c, #a87d5a); color: #0a0a0f; font-weight: 700; padding: 12px; border-radius: 50px; border: none; transition: all 0.4s ease; width: 100%; cursor: pointer; }
        .btn-glow:hover { transform: translateY(-2px); box-shadow: 0 0 40px rgba(196,154,108,0.2); }
        .logo-glow { font-size: 2.5rem; font-weight: 700; background: linear-gradient(135deg, #c49a6c, #e8c99a); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body>
    <div class="w-full max-w-md px-4">
        <div class="card-glass p-8">
            <div class="text-center">
                <div class="logo-glow">🎵 Museo</div>
                <p class="text-[#888] mt-2 text-sm">Regístrate como visitante</p>
                <p class="text-[#666] text-xs mt-1">La jefa debe aprobar tu solicitud</p>
            </div>

            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/20 text-green-400 p-3 rounded-lg mt-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-3 rounded-lg mt-4 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- 🔑 MOSTRAR CONTRASEÑA POR DEFECTO -->
            <div class="bg-blue-500/10 border border-blue-500/20 text-blue-400 p-3 rounded-lg mt-4 text-sm text-center">
                🔑 Tu contraseña será: <strong>visitante123</strong>
                <br><span class="text-xs">Guárdala para iniciar sesión después de la aprobación.</span>
            </div>

            <form method="POST" action="{{ route('register.visitante') }}" class="mt-6">
                @csrf

                <div class="mb-4">
                    <label class="block text-[#c49a6c] font-semibold text-sm mb-1">Nombre</label>
                    <input type="text" name="name" class="input-dark" required autofocus>
                </div>

                <div class="mb-6">
                    <label class="block text-[#c49a6c] font-semibold text-sm mb-1">Email</label>
                    <input type="email" name="email" class="input-dark" required>
                </div>

                <button type="submit" class="btn-glow">
                    Solicitar Acceso
                </button>
            </form>

            <p class="text-center text-[#666] text-sm mt-4">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-[#c49a6c] hover:text-[#d4aa7c]">Inicia Sesión</a>
            </p>
        </div>
    </div>
</body>
</html>
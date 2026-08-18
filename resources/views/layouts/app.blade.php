<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Museo de Instrumentos')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0f;
            color: #e0e0e0;
            min-height: 100vh;
        }

        .font-display { font-family: 'Playfair Display', serif; }

        /* NAVBAR GLASS */
        .navbar-glass {
            background: rgba(10, 10, 15, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(196, 154, 108, 0.15);
            box-shadow: 0 0 30px rgba(196, 154, 108, 0.03);
        }

        .navbar-glass a {
            color: #b0b0b0;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-glass a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0%;
            height: 2px;
            background: #c49a6c;
            transition: width 0.3s ease;
            box-shadow: 0 0 10px #c49a6c;
        }

        .navbar-glass a:hover::after {
            width: 100%;
        }

        .navbar-glass a:hover {
            color: #c49a6c;
        }

        .logo-glow {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #c49a6c, #e8c99a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 40px rgba(196, 154, 108, 0.15);
        }

        /* CARD GLASS */
        .card-glass {
            background: rgba(20, 20, 30, 0.7);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(196, 154, 108, 0.08);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.02);
            transition: all 0.4s ease;
        }

        .card-glass:hover {
            border-color: rgba(196, 154, 108, 0.25);
            box-shadow: 0 8px 40px rgba(196, 154, 108, 0.04), inset 0 1px 0 rgba(255, 255, 255, 0.02);
        }

        /* INPUT DARK */
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

        /* BTN GLOW */
        .btn-glow {
            background: linear-gradient(135deg, #c49a6c, #a87d5a);
            color: #0a0a0f;
            font-weight: 700;
            padding: 12px 32px;
            border-radius: 50px;
            border: none;
            transition: all 0.4s ease;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.85rem;
            box-shadow: 0 0 30px rgba(196, 154, 108, 0.1);
            cursor: pointer;
        }

        .btn-glow:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 0 50px rgba(196, 154, 108, 0.25);
            background: linear-gradient(135deg, #d4aa7c, #b88d6a);
        }

        .btn-outline-glow {
            background: transparent;
            color: #c49a6c;
            font-weight: 600;
            padding: 12px 32px;
            border-radius: 50px;
            border: 1px solid rgba(196, 154, 108, 0.25);
            transition: all 0.4s ease;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.85rem;
        }

        .btn-outline-glow:hover {
            background: rgba(196, 154, 108, 0.08);
            border-color: #c49a6c;
            box-shadow: 0 0 40px rgba(196, 154, 108, 0.08);
            transform: translateY(-3px);
        }

        /* SCROLLBAR */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0a0a0f; }
        ::-webkit-scrollbar-thumb { background: #c49a6c; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #d4aa7c; }

        /* ANIMACIONES */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp { animation: fadeInUp 1s ease-out; }
    </style>
    @stack('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar-glass fixed w-full z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('home') }}" class="logo-glow">🎵 Museo</a>
            <div class="flex gap-6 text-white items-center">
                <a href="{{ route('instrumentos.index') }}" class="text-sm font-medium tracking-wide">Colección</a>
                <a href="{{ route('visita.virtual') }}" class="text-sm font-medium tracking-wide">Visita Virtual</a>

                @auth
                    <!-- BOTÓN ADMIN (SOLO PARA JEFA) -->
                    @if(Auth::user()->role === 'jefa')
                        <a href="{{ route('admin.index') }}" class="text-[#c49a6c] hover:text-[#d4aa7c] transition text-sm font-medium">👑 Admin</a>
                    @endif

                    <!-- CERRAR SESIÓN -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-400/70 hover:text-red-400 transition text-sm">Cerrar Sesión</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- CONTENIDO -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#0a0a0f] text-[#444] py-8 text-center border-t border-[#1a1a1a]">
        <div class="container mx-auto px-4">
            <p>© 2026 · Museo de Instrumentos Musicales · La Paz · Bolivia</p>
            <p class="text-sm text-[#333] mt-1">Proyecto de Grado · Michelle Angie Cruz Portillo</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
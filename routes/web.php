<?php

use App\Http\Controllers\InstrumentoController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComentarioController;
use Illuminate\Support\Facades\Route;

// 🔓 PÁGINAS PÚBLICAS
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/visita-virtual', [InstrumentoController::class, 'visitaVirtual'])->name('visita.virtual');
Route::get('/qr-lista', [InstrumentoController::class, 'showQrLista'])->name('qr.lista');

// 🔐 LOGIN
Route::get('/login', [CustomAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [CustomAuthController::class, 'login']);
Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');

// Registro de visitantes
Route::get('/register-visitante', [CustomAuthController::class, 'showRegisterVisitante'])->name('register.visitante');
Route::post('/register-visitante', [CustomAuthController::class, 'registerVisitante']);

// 🔒 RUTAS PROTEGIDAS (REQUIEREN LOGIN)
Route::middleware(['auth'])->group(function () {

    // CRUD de instrumentos
    Route::resource('instrumentos', InstrumentoController::class);

    // Comentarios
    Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');

    // Panel de administración (solo jefa)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::post('/create-admin', [AdminController::class, 'createAdmin'])->name('create-admin');
        Route::post('/aprobar/{id}', [AdminController::class, 'aprobarVisitante'])->name('aprobar');
        Route::post('/rechazar/{id}', [AdminController::class, 'rechazarVisitante'])->name('rechazar');
        Route::delete('/user/{id}', [AdminController::class, 'destroy'])->name('destroy-user');
        Route::get('/comentarios', [AdminController::class, 'comentarios'])->name('comentarios');
        Route::post('/comentario/{id}/leido', [AdminController::class, 'marcarLeido'])->name('marcar-leido');
    });
});
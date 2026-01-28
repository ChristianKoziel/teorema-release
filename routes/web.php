<?php

use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\Admin\ReleaseController as AdminReleaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas públicas
Route::get('/releases', [ReleaseController::class, 'index'])->name('releases.index');
Route::get('/releases/{release}', [ReleaseController::class, 'show'])->name('releases.show');

// Rotas protegidas para usuários autenticados
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/minha-area', [ReleaseController::class, 'minhaArea'])->name('releases.minha-area');
    
    // Área administrativa - apenas admin e analista
    Route::middleware(['admin-analista'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/releases', [AdminReleaseController::class, 'index'])->name('releases.index');
        Route::get('/releases/create', [AdminReleaseController::class, 'create'])->name('releases.create');
        Route::post('/releases', [AdminReleaseController::class, 'store'])->name('releases.store');
        Route::get('/releases/{release}', [AdminReleaseController::class, 'show'])->name('releases.show');
        Route::get('/releases/{release}/edit', [AdminReleaseController::class, 'edit'])->name('releases.edit');
        Route::put('/releases/{release}', [AdminReleaseController::class, 'update'])->name('releases.update');
        Route::delete('/releases/{release}', [AdminReleaseController::class, 'destroy'])->name('releases.destroy');
        Route::post('/releases/{release}/status', [AdminReleaseController::class, 'alterarStatus'])->name('releases.status');
    });
});

require __DIR__.'/auth.php';
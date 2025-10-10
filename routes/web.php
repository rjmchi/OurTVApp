<?php

use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [ProgramController::class, 'index'])->name('home');
    Route::get('dashboard', [ProgramController::class, 'index'])->name('dashboard');
    Route::put('programs/{program}/next-episode', [ProgramController::class, 'nextEpisode'])->name('nextepisode');
    Route::put('programs/{program}/next-season', [ProgramController::class, 'nextSeason'])->name('nextseason');
    Route::put('programs/{program}/togglevpn', [ProgramController::class, 'toggleVPN'])->name('togglevpn');
    Route::post('programs', [ProgramController::class, 'store'])->name('programs.store');
    Route::delete('programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

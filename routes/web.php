<?php

use App\Http\Controllers\NotesController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::resource('notes', NotesController::class)
    ->only(['show', 'store', 'update', 'destroy']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

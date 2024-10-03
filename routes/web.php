<?php

use App\Http\Controllers\NotesController;
use App\Livewire\NotesOverview;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/notes', NotesOverview::class)
    ->middleware('role:student,admin')
    ->name('notes.index');

Route::resource('notes', NotesController::class)
    ->middleware(['auth:web'])
    ->only(['show', 'store', 'update', 'destroy']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

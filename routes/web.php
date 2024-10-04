<?php

use App\Http\Controllers\NotesController;
use App\Livewire\Notes\NotesOverview;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/notes', NotesOverview::class)
    ->middleware(['auth:web', 'role:student,teacher'])
    ->name('notes.index');

Route::resource('notes', NotesController::class)
    ->only(['show', 'store', 'update', 'destroy'])
    ->middleware(['auth:web']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

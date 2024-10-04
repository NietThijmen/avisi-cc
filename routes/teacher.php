<?php
Route::middleware(['auth:web', 'role:teacher'])->prefix('/teacher')->group(function () {
    \Livewire\Volt\Volt::route('/assignment', 'pages.teacher.assignment')->name('teacher.assignment');
});

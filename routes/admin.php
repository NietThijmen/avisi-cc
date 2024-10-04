<?php


use Livewire\Volt\Volt;

Route::prefix('/admin')->middleware('auth')->group(function () {
    Volt::route("/dashboard", 'pages.admin.dashboard')
        ->name('admin.dashboard');

    Volt::route("/students", 'pages.admin.students')
        ->name('admin.students');

    Volt::route('/teachers', 'pages.admin.teachers')
        ->name('admin.teachers');

    Volt::route('/admins', 'pages.admin.administrators')
        ->name('admin.admins');

    Volt::route("/crebos", 'pages.admin.crebos')
        ->name('admin.crebos');

    Volt::route("/crebo/{crebo}", 'pages.admin.edit-crebo')
        ->name('admin.crebo.edit');

    Volt::route("/education-rubric/{educationRubric}", 'pages.admin.edit-education-rubric')
        ->name('admin.education-rubric.edit');
});

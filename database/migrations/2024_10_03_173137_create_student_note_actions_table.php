<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_note_actions', function (Blueprint $table) {
            $table->id();
            $table->ForeignIdFor(\App\Models\StudentNote::class);
            $table->ForeignIdFor(\App\Models\User::class);
            $table->enum('action', ['Read', 'Create', 'Update']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_note_actions');
    }
};

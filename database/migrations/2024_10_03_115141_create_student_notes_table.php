<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->renameColumn('user_id', 'id');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('user_id', 'id');
        });

        Schema::create('student_notes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 128);
            $table->foreignIdFor(\App\Models\Student::class);
            $table->foreignIdFor(\App\Models\Teacher::class);
            $table->string('content', 2048);
            $table->boolean('read');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_notes');
    }
};

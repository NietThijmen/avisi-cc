<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['Student', 'Teacher'])->default('Student');
            // Each user has the default role of student
            // This will be used for the polymorphic relationship
        });
    }
};

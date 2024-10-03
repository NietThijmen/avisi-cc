<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->primary();
            $table->integer('student_number')->unique();
            $table->string('class', 32);
            $table->string('crebo_number', 16);
            $table->date('cohort');
            $table->date('date_of_birth');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};

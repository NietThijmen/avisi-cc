<?php

use App\Models\Crebo;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->foreignIdFor(User::class)
                ->primary()
                ->constrained();
            $table->integer('student_number')->unique();
            $table->string('class', 32);
            $table->foreignIdFor(Crebo::class)->constrained();
            $table->date('cohort');
            $table->date('date_of_birth');
            $table->foreignIdFor(Teacher::class, 'career_coach_id')
                ->nullable()
                ->constrained('teachers', 'user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};

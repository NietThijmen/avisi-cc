<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('education_rubrics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('crebo_id')->constrained('crebos')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('criteria', function (Blueprint $table) {
            $table->id();
            $table->text('criteria');
            $table->foreignIdFor(\App\Models\EducationRubric::class)->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_rubrics');
    }
};

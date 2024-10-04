<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('education_rubrics_users', function (Blueprint $table) {
                $table->id();

                $table->foreignIdFor(\App\Models\EducationRubric::class);
                $table->foreignIdFor(\App\Models\User::class);

                $table->softDeletes();
                $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('education_rubrics_users', function (Blueprint $table) {
            //
        });
    }
};

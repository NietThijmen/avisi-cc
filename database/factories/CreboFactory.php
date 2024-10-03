<?php

namespace Database\Factories;

use App\Models\Crebo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CreboFactory extends Factory
{
    protected $model = Crebo::class;

    public function definition(): array
    {
        return [
            'crebo' => fake()->randomNumber(5),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

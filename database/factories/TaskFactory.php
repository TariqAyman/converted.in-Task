<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        if (!User::query()->count()){
            return ;
        }
        return [
            'title' => fake()->title,
            'description' => fake()->text,
            'assigned_to_id' => User::query()->inRandomOrder()->first()->id,
            'assigned_by_id' => User::query()->inRandomOrder()->first()->id,
        ];
    }
}

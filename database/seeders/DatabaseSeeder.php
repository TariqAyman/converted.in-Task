<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'admin@admin.com',
            'user_type' => 'admin',
        ]);

        User::factory()->count(100)->create([
            'user_type' => 'admin',
        ]);

        User::factory()->count(1000)->create();

//        Task::factory()->count(100)->create();
    }
}

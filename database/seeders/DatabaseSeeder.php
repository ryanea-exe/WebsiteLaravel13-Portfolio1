<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AboutSeeder;
use Database\Seeders\EducationSeeder;
use Database\Seeders\MediaSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\SkillSeeder;
use Database\Seeders\ExperienceSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        $this->call(
            [AboutSeeder::class],
            [EducationSeeder::class],
            [MediaSeeder::class],
            [ServiceSeeder::class],
            [SkillSeeder::class],
            [ExperienceSeeder::class],
        );
    }
}

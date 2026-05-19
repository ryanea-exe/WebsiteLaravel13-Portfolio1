<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('experiences')->insert([
            [
                'company' => 'Kantor Imigrasi Kelas II Non TPI Ponorogo',
                'period' => 'Nov 2025 - May 2026',
                'position' => 'Pengelola Kesisteman'
            ]
        ]);
    }
}

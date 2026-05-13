<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'name' => 'UI/UX Designer',
                'icon' => 'uil uil-web-grid',
                'description' => 'I create a ui and ux design for the website that is easy to use and understand.',
            ],
            [
                'name' => 'Web Developer',
                'icon' => 'uil uil-arrow',
                'description' => 'I create a website that is responsive and easy to use.',
            ],
            [
                'name' => 'Content Creator',
                'icon' => 'uil uil-edit',
                'description' => 'I create a content that is easy to understand and use.',
            ],
        ]);
    }
}

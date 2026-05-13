<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('abouts')->insert([
            'name' => 'Ryan Erlangga Ardiansyah',
            'phone' => '62 857-3210-6401',
            'email' => 'ryanhillfree23@gmail.com',
            'address' => 'Ponorogo, Jawa Timur, Indonesia',
            'description' => 'Ryan Erlangga Ardiansyah is a passionate developer with experience in various technologies.',
            'summary' => 'Experienced developer with a strong background in web development.',
            'tagline' => 'Creating innovative solutions for modern businesses.',
            'cv' => 'cv_ryan.pdf'
        ]);
    }
}

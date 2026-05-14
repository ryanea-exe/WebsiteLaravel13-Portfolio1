<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skills')->insert([
            [
                'name' => 'PHP',
                'proficiency' => '90',
                'service_id' => '1'
            ],
            [
                'name' => 'NODE JS',
                'proficiency' => '80',
                'service_id' => '1'
            ],
            [
                'name' => 'JAVASCRIPT',
                'proficiency' => '75',
                'service_id' => '1'
            ]
        ]);
    }
}

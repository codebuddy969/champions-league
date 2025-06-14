<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Week;

class WeeksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Week::insert([
            ['title' => '1st'],
            ['title' => '2nd'],
            ['title' => '3rd'],
            ['title' => '4th'],
            ['title' => '5th'],
            ['title' => '6th'],
        ]);
    }
}

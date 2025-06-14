<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::insert([
            ['name' => 'ManCity'],
            ['name' => 'Chelsea'],
            ['name' => 'Everton'],
            ['name' => 'Leicester'],
        ]);
    }
}


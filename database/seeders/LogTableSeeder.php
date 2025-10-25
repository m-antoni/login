<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Logs;

class LogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Logs::factory()->count(5)->create();
    }
}

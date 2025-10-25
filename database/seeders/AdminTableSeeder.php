<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Admin; 

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'username' => 'admin',
            'password' => bcrypt('123456'),
        ]);
    }
}

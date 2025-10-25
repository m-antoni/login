<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Register;

class RegisterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Register::factory()->count(100)->create();
    }
}

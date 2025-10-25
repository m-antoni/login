<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Notification; 

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::factory()->count(10)->create();
    }
}
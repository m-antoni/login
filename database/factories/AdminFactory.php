<?php

namespace Database\Factories;

use App\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition(): array
    {
        return [
            'username' => 'admin',
            'password' => Hash::make('123456'),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'title'        => $this->faker->name(),
            'register_id'  => $this->faker->randomDigit(),
            'description'  => 'Time In: ' . now(),
            'date'         => now(),
        ];
    }
}

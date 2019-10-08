<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Notification::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'register_id' => $faker->randomDigit,
        'description' => 'Time In: ' .  now(),
        'date' => now(),
    ];
});

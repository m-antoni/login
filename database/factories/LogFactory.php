<?php

use Faker\Generator as Faker;

$factory->define(App\Logs::class, function (Faker $faker) {
    return [
    	'register_id' => $faker->randomDigit, 
        'qrcode' => $faker->sha256,
        'name' => $faker->name,
        'log_in' => $faker->dateTime,
        'log_out' => $faker->dateTime,
        'late' => $faker->dateTime,
        'under' => $faker->dateTime,
        'status' => $faker->randomElement(array(true, false)),
    ];
});

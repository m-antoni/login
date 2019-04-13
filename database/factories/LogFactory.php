<?php

use Faker\Generator as Faker;

$factory->define(App\Logs::class, function (Faker $faker) {
    return [
    		'register_id' => 0, 
        'qrcode' => $faker->sha256,
        'name' => $faker->name,
        'time_in' => $faker->dateTime,
        'time_out' => $faker->dateTime,
        'status' => $faker->randomElement(array('Active', 'Inactive')),
    ];
});

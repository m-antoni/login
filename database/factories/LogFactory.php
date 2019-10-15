<?php

use Faker\Generator as Faker;

$factory->define(App\Logs::class, function (Faker $faker) {
    return [
    	'register_id' => $faker->randomDigit, 
        'qrcode' => $faker->sha256,
        'name' => $faker->name,
        'log_in' => $faker->dateTime,
        'log_out' => $faker->dateTime,
        'late' =>  0,
        'under' => 0,
        'status' => $faker->randomElement(array(true, false)),
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'username' => 'admin',
        'password' => bcrypt('123456')
    ];
});

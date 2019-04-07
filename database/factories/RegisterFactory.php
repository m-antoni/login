<?php

use Faker\Generator as Faker;

$factory->define(App\Register::class, function (Faker $faker) {
    return [
        'first' => $faker->randomElement(array($faker->firstNameMale, $faker->firstNameFemale)),
        'last' => $faker->lastName,
        'gender' => $faker->randomElement(array('Male', 'Female')),
        'middle' => strtoupper($faker->randomLetter),
        'age' => $faker->numberBetween($min = 18, $max = 35),
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'contact' => $faker->numerify('09#########'),
        'email' => $faker->email,
        'address' => $faker->address,
        'department' => $faker->numberBetween($min = 0, $max = 6),
        'date_hired' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'user_type' => $faker->randomElement(array('Employee', 'Intern')),
        'id_number' => $faker->numerify('2019####'),
        'photo' => 'default.jpg',
    ];
});

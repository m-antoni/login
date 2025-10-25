<?php

namespace Database\Factories;

use App\Register;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegisterFactory extends Factory
{
    protected $model = Register::class;

    public function definition(): array
    {
        return [
            'qrcode'      => $this->faker->sha256(),
            'first'       => $this->faker->firstName(),
            'last'        => $this->faker->lastName(),
            'middle'      => $this->faker->randomElement(['A.', 'B.', 'C.', null]),
            'gender'      => $this->faker->randomElement(['Male', 'Female']),
            'age'         => $this->faker->numberBetween(18, 60),
            'birthday'    => $this->faker->date('Y-m-d', '-18 years'),
            'contact'     => $this->faker->phoneNumber(),
            'email'       => $this->faker->unique()->safeEmail(),
            'address'     => $this->faker->address(),
            'department'  => $this->faker->numberBetween(1, 5),
            'date_hired'  => $this->faker->date('Y-m-d', '-1 year'),
            'user_type'   => $this->faker->randomElement(['Employee', 'Admin']),
            'id_number'   => strtoupper($this->faker->bothify('EMP###')),
            'photo'       => 'photos/default.jpg',
        ];
    }
}

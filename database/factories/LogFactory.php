<?php

namespace Database\Factories;

use App\Logs;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogsFactory extends Factory
{
    /**
     * The name of the corresponding model.
     *
     * @var string
     */
    protected $model = Logs::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'register_id' => $this->faker->randomDigit(),
            'qrcode' => $this->faker->sha256(),
            'name' => $this->faker->name(),
            'log_in' => $this->faker->dateTime(),
            'log_out' => $this->faker->dateTime(),
            'late' => 0,
            'under' => 0,
            'status' => $this->faker->boolean(),
        ];
    }
}

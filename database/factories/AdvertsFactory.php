<?php

namespace Database\Factories;

use App\Models\Adverts;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdvertsFactory extends Factory
{
    protected $model = Adverts::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(\App\Enum\AdvertType::cases()),
            'price' => $this->faker->randomNumber(2),
            'starting_price' => $this->faker->randomNumber(2),
            'start_date' => $this->faker->dateTime(),
            'expiry_date' => $this->faker->dateTime(),
            // Add any other fields as necessary...
        ];
    }
}
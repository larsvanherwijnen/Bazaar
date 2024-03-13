<?php

namespace Database\Factories;

use App\Models\Advert;
use App\Models\AdvertImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdvertFactory extends Factory
{
    protected $model = Advert::class;

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

    public function withImage()
    {
        return $this->has(AdvertImage::factory()->count(1));
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertImageFactory extends Factory
{
    public function definition()
    {
        return [
            'path' => $this->faker->image(public_path('storage/images'), 500, 500, null, false),
        ];
    }
}

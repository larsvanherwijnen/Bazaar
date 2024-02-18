<?php

namespace Database\Factories;

use App\Models\AdvertImage;
use App\Models\Advert;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdvertImageFactory extends Factory
{
    protected $model = AdvertImage::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(),
            'path' => $this->faker->imageUrl(),
        ];
    }
}
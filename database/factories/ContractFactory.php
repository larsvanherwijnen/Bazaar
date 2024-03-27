<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'approved_by' => \App\Models\User::factory(['type' => \App\Enum\RolesEnum::ADMIN]),
            'path' => $this->faker->filePath(),
            'approved_at' => $this->faker->dateTime(),
        ];
    }
}

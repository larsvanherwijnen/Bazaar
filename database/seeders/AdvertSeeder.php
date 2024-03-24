<?php

namespace Database\Seeders;

use App\Enum\RolesEnum;
use App\Models\Advert;
use App\Models\AdvertImage;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdvertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(['type' => RolesEnum::PRIVATE_WITH_ADVERTISING])->has(Advert::factory()->has(AdvertImage::factory(2))->count(rand(1,5)))->create();
        User::factory(['type' => RolesEnum::BUSINESS])->has(Company::factory())->has(Advert::factory()->has(AdvertImage::factory(2))->count(rand(1,5)))->create();
    }
}

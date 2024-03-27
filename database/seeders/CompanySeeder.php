<?php

namespace Database\Seeders;

use App\Enum\RolesEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(['type' => RolesEnum::BUSINESS])->has(Company::factory())->count(1)->create();
    }
}

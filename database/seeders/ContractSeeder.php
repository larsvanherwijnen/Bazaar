<?php

namespace Database\Seeders;

use App\Enum\RolesEnum;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contract::factory(3)->for(User::Factory(['type' => RolesEnum::BUSINESS]))->create();
    }
}

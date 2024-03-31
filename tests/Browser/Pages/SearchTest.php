<?php

namespace Tests\Browser\Pages;

use App\Enum\AdvertType;
use App\Models\Advert;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SearchTest extends DuskTestCase
{
    public function testFilterByType()
    {
        Artisan::call('migrate:fresh');

        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            Advert::factory()->count(5)->create(['type' => AdvertType::SALE, 'user_id' => $user->id]);
            Advert::factory()->count(3)->create(['type' => AdvertType::RENTAL, 'user_id' => $user->id]);

            $browser->visit('/')
                ->keys('@search', '{enter}') // Simulate pressing Enter in the search bar
                ->assertSee(__('advert.all_advert_types'))
                ->select('@advertType', AdvertType::SALE->value)
                ->assertPresent('@advert-card', 5)
                ->select('@advertType', AdvertType::RENTAL->value)
                ->assertPresent('@advert-card', 3);
        });
    }

    public function testFilterByPriceRange()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            Advert::factory()->create(['price' => 20, 'user_id' => $user->id]);
            Advert::factory()->create(['price' => 40, 'user_id' => $user->id]);
            Advert::factory()->create(['price' => 60, 'user_id' => $user->id]);

            $browser->visit('/adverts')
                ->type('@minPrice', 30)
                ->type('@maxPrice', 50)
                ->assertPresent('@advert-card', 2);
        });
    }

    public function testSearch()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            Advert::factory()->create(['title' => 'Laravel Job', 'user_id' => $user->id]);
            Advert::factory()->create(['title' => 'PHP Developer', 'user_id' => $user->id]);

            $browser->visit('/adverts')
                ->type('@search', 'Laravel')
                ->assertPresent('@advert-card', 1)
                ->type('@search', 'NotLaravel')
                ->assertPresent('@advert-card', 0);
        });
    }
}

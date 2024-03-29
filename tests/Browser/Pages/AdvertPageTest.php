<?php

namespace Tests\Browser\Pages;

use App\Enum\AdvertType;
use App\Models\Advert;
use App\Models\AdvertImage;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdvertPageTest extends DuskTestCase
{
    public function testAdvertPage()
    {
        $user = User::factory()->create();
        $advert = Advert::factory()->create(['user_id' => $user->id]);

        $this->browse(function (Browser $browser) use ($user, $advert) {
            $browser->loginAs($user)
                ->visit(route('adverts.show', $advert))
                ->assertSee($advert->title)
                ->assertSee($advert->description);
        });
    }

    public function testAdvertPageWithSeller()
    {
        $user = User::factory()->create();
        $advert = Advert::factory()->create(['user_id' => $user->id]);
        AdvertImage::factory()->create(['advert_id' => $advert->id]);

        $this->browse(function (Browser $browser) use ($user, $advert) {
            $browser->loginAs($user)
                ->visit(route('adverts.show', $advert))
                ->assertSee($advert->title)
                ->assertSee($advert->description)
                ->assertSourceHas('mainImage')
                ->assertSee($advert->user->name);
        });
    }

    public function testAdvertTypesCorrectFields()
    {
        $user = User::factory()->create();
        $advertData = [
            ['type' => AdvertType::AUCTION],
            ['type' => AdvertType::BIDDING],
            ['type' => AdvertType::RENTAL],
            ['type' => AdvertType::SALE],
        ];

        // assertions per type
        foreach ($advertData as $data) {
            $advert = Advert::factory()->create(array_merge(['user_id' => $user->id], $data));

            $this->browse(function (Browser $browser) use ($user, $advert) {
                $browser->loginAs($user)
                    ->visit(route('adverts.show', $advert))
                    ->assertSee($advert->title)
                    ->assertSee($advert->description);

                switch ($advert->type) {
                    case AdvertType::BIDDING:
                        $browser->assertSee(__('advert.bidding'))
                            ->assertSee(__('advert.place_bid'));
                        break;
                    case AdvertType::RENTAL:
                        $browser->assertSee(__('advert.rental'))
                            ->assertSee(__('advert.start_date'))
                            ->assertSee(__('advert.end_date'))
                            ->assertSee(__('advert.place_booking'))
                            ->assertSee($advert->price);
                        break;
                    case AdvertType::SALE:
                        $browser->assertSee($advert->price);
                        break;
                }
            });
        }
    }

    public function testBidPlacement()
    {
        $user = User::factory()->create();
        $advert = Advert::factory()->create(['type' => AdvertType::BIDDING, 'user_id' => $user->id]);

        $this->browse(function (Browser $browser) use ($user, $advert) {
            $browser->loginAs($user)
                ->visit(route('adverts.show', $advert))
                ->waitForText(__('advert.bidding'))
                ->assertSee(__('advert.bidding'))
                ->assertSee(__('advert.no_bids_yet'))
                ->type('#amount', '53')
                ->press(__('advert.place_bid'))
                ->waitForText('€53.00')
                ->assertSee('€53.00');
        });
    }
}

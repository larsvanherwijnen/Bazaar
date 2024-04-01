<?php

namespace Tests\Browser\Pages;

use App\Enum\AdvertType;
use App\Models\Advert;
use App\Models\AdvertImage;
use App\Models\Rental;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdvertPageTest extends DuskTestCase
{
    public function testAdvertPage(): void
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

    public function testAdvertPageWithSeller(): void
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

    public function testAdvertTypesCorrectFields(): void
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

    public function testBidPlacement(): void
    {
        $user = User::factory()->create();
        $advert = Advert::factory()->create(['type' => AdvertType::BIDDING, 'user_id' => $user->id]);

        $this->browse(function (Browser $browser) use ($user, $advert) {
            $browser->loginAs($user)
                ->visit(route('adverts.show', $advert))
                ->waitForText(__('advert.bidding'), 2)
                ->assertSee(__('advert.bidding'))
                ->assertSee(__('advert.no_bids_yet'))
                ->type('#amount', '53')
                ->press(__('advert.place_bid'))
                ->waitForText('€53.00')
                ->assertSee('€53.00');
        });
    }

    public function testBookingPlacement(): void
    {
        $user = User::factory()->create();
        $advert = Advert::factory()->create(['type' => AdvertType::RENTAL, 'user_id' => $user->id]);

        $this->browse(function (Browser $browser) use ($user, $advert) {
            $browser->loginAs($user)
                ->visit(route('adverts.show', $advert))
                ->waitForText(__('advert.rental'), 2)
                ->assertSee(__('advert.rental'))
                ->assertSee(__('advert.start_date'))
                ->assertSee(__('advert.end_date'))
                ->assertSee(__('advert.place_booking'))
                ->type('#start', now()->format('Y-m-d'))
                ->type('#end', now()->addDays(2)->format('Y-m-d'))
                ->press(__('advert.place_booking'));
        });
    }

    public function testAdvertDeletion(): void
    {
        $user = User::factory()->create();
        $advert = Advert::factory()->create(['user_id' => $user->id]);

        $this->browse(function (Browser $browser) use ($user, $advert) {
            $browser->loginAs($user)
                ->visit(route('adverts.show', $advert))
                ->waitForText($advert->title, 2)
                ->assertSee($advert->title)
                ->press(__('global.delete'));
        });
    }

    public function testAdvertEdit(): void
    {
        $user = User::factory()->create();
        $advert = Advert::factory()->create(['user_id' => $user->id]);

        $this->browse(function (Browser $browser) use ($user, $advert) {
            $browser->loginAs($user)
                ->visit(route('adverts.show', $advert))
                ->waitForText($advert->title, 2)
                ->assertSee($advert->title)
                ->press('#edit')
                ->waitForText(__('advert.create_advert'))
                ->assertSee(__('advert.create_advert'))
                ->type('title', 'New title')
                ->press('#save');
        });
    }

    public function testBuyAdvert(){
        $user = User::factory()->create();
        $advertOwner = User::factory()->create();

        $advert = Advert::factory()->create(['user_id' => $advertOwner->id, 'type' => AdvertType::SALE, 'price' => 100]);

        $this->browse(function (Browser $browser) use ($user, $advert) {
            $browser->loginAs($user)
                ->visit(route('adverts.show', $advert))
                ->waitForText($advert->title, 2)
                ->assertSee($advert->title)
                ->press("#buy");
        });
    }


    public function testAdvertPageWithImages(): void
    {
        $user = User::factory()->create();
        $advert = Advert::factory()->create(['user_id' => $user->id]);
        AdvertImage::factory()->create(['advert_id' => $advert->id]);

        $this->browse(function (Browser $browser) use ($user, $advert) {
            $browser->loginAs($user)
                ->visit(route('adverts.show', $advert))
                ->assertSee($advert->title)
                ->assertSee($advert->description)
                ->assertSourceHas('mainImage');
        });
    }

    public function testViewPurchasedAdverts()
    {
        // Create a user
        $user = User::factory()->create();
        $userBuyer = User::factory()->create();

        // Create purchased adverts
        $purchasedAdverts = Advert::factory()->count(3)->create(['user_id' =>$user->id ,'bought_by' => $userBuyer->id]);

        $this->browse(function (Browser $browser) use ($userBuyer, $purchasedAdverts) {
            $browser->loginAs($userBuyer)
                ->visit(route('my-account.purchased-adverts'));

            foreach ($purchasedAdverts as $advert) {
                $browser->assertSee($advert->title);
            }
        });
    }
}

<?php

namespace Tests\Browser\Pages;
use App\Models\Advert;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{

    /**
     * Test that the adverts view displays "No adverts found" when there are no adverts.
     *
     * @test
     */
    public function testNoAdverts(): void
    {
        Artisan::call('migrate:fresh');
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('No adverts found.');
        });
    }

    /**
     * Test that adverts are displayed correctly with title, price, and image.
     *
     * @test
     */
    public function testAdvertDisplay(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create sample adverts (adjust model and path if needed)
        $advert1 = Advert::factory()->create(['title' => 'Test Advert 1', 'user_id' => $user1->id], );
        $advert2 = Advert::factory()->create(['title' => 'Test Advert 2', 'user_id' => $user2->id]);

        $this->browse(function (Browser $browser) use ($advert1, $advert2) {
            $browser->visit('/') // Visit the homepage

            // Verify presence of advert titles
            ->assertSee($advert1->title)
                ->assertSee($advert2->title)

                // Optional: Check for additional elements like price or image (if verification logic is available)
            ;
        });
    }

    /**
     * Test clicking on an advert link navigates to the correct detail page.
     *
     * @test
     */
    public function testAdvertLinkClick(): void
    {
        $user = User::factory()->create(['type' => 1] );
        $advert = Advert::factory()->create(['user_id' => $user->id]);
        $this->browse(function (Browser $browser) use ($advert) {
            $browser->visit('/')
                ->assertSeeLink($advert->title)
                ->clickLink($advert->title)
                ->assertUrlIs(route('adverts.show', $advert)); // Verify URL using route helper
        });
    }
}


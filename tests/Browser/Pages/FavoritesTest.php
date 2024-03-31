<?php

namespace Tests\Browser\Pages;

use App\Models\Favorite;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Advert;

class FavoritesTest extends DuskTestCase
{
    /**
     * Test that a user can add an advert to their favorites.
     */
    public function testUserCanAddToFavorites(): void
    {
        // Create a user and an advert
        $user = User::factory()->create();
        $advert = Advert::factory()->create(['user_id' => $user->id]);

        $this->browse(function (Browser $browser) use ($user, $advert) {
            $browser->loginAs($user)
                ->visitRoute('adverts.show', ['advert' => $advert])
                ->waitFor('@favorite')
                ->press('@favorite')
                ->waitFor('@unfavorite');
        });

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'advert_id' => $advert->id,
        ]);
    }

    /**
     * Test that a user can remove an advert from their favorites.
     */
    public function testUserCanRemoveFromFavorites(): void
    {
        // Create a user and an advert
        $user = User::factory()->create();
        $advert = Advert::factory()->create(['user_id' => $user->id]);
        Favorite::create(['user_id' => $user->id, 'advert_id' => $advert->id]);


        $this->browse(function (Browser $browser) use ($user, $advert) {
            $browser->loginAs($user)
                ->visitRoute('adverts.show', ['advert' => $advert->id])
                ->waitFor('@unfavorite')
                ->press('@unfavorite')
                ->waitFor('@favorite');
        });

        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'advert_id' => $advert->id,
        ]);
    }

    /**
     * Test that a user can see their favorites.
     */
   public function testUserCanSeeFavorites(): void
    {
    $user = User::factory()->create();
    $advert1 = Advert::factory()->create(['user_id' => $user->id]);
    $advert2 = Advert::factory()->create(['user_id' => $user->id]);

    Favorite::create(['user_id' => $user->id, 'advert_id' => $advert1->id]);

    $this->browse(function (Browser $browser) use ($user, $advert1, $advert2) {
        $browser->loginAs($user)
            ->visitRoute('my-account.favorites')
            ->assertSee($advert1->title)
            ->assertDontSee($advert2->title);
    });
}
}
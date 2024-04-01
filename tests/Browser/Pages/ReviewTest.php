<?php

namespace Tests\Browser\Pages;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ReviewTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testUserProfilePage()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(route('profile', $user->url))
                ->assertSee($user->name);
        });
    }


    public function testReviewModal() {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $user2) {
            $browser->loginAs($user2)
                ->visit(route('profile', $user->url))
                ->click('#showReview');
        });
    }
}

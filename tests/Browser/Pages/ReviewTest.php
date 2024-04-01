<?php

namespace Tests\Browser\Pages;

use App\Enum\RolesEnum;
use App\Models\Company;
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
        if ($user->type === RolesEnum::BUSINESS) {
            Company::factory()->create(['user_id' => $user->id]);
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(route('profile', $user->url))
                ->waitForText($user->name)
                ->assertSee($user->name);
        });
    }


    public function testReviewModal() {
        $user = User::factory()->create();
        if ($user->type === RolesEnum::BUSINESS) {
            Company::factory()->create(['user_id' => $user->id]);
        }
        $user2 = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $user2) {
            $browser->loginAs($user2)
                ->visit(route('profile', $user->url))
                ->click('#showReview');
        });
    }
}

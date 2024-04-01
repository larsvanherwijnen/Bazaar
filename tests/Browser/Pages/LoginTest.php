<?php

namespace Tests\Browser\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create([
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
            ]);

            $browser->visit(route('login'))
                ->assertSee(__('auth.login'))
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('#login')
                ->waitForLocation('/')
                ->assertPathIs('/');
        });
    }
}

<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testPageVisit(): void
    {
        $this->browse(function (Browser $browser) {
            // Visit the registration page
            $browser->visitRoute('register')
                // Assert that the page loads successfully
                ->assertSee(__('registration.register'))
                ->assertSee(__('registration.username'))
                ->assertSee(__('registration.email'))
                ->assertSee(__('registration.password'))
                ->assertSee(__('registration.confirm_password'))
                ->assertSee(__('registration.private'))
                ->assertSee(__('registration.business'));
        });
    }

    public function testRegistrationForPrivateWithoutAdvertising()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->assertSee(__('registration.register'))
                ->click('label[for="private_without_advertising"]')
                ->type('username', 'testuser')
                ->type('email', 'test@example.com')
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press('Register')
                ->assertSee(__('auth.login'));
        });
    }

    public function testRegistrationForPrivateWithAdvertising()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->assertSee(__('registration.register'))
                ->click('label[for="private_with_advertising"]')
                ->type('username', 'testuser')
                ->type('email', 'test@example.com')
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press('Register')
                ->assertSee(__('auth.login'));
        });
    }

    public function testRegistrationForBusiness()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->waitForText(__('registration.register'))
                ->assertSee(__('registration.register'))
                ->click('label[for="business"]')
                ->type('username', 'testuser')
                ->type('email', 'test@example.com')
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->type('companyName', 'Test Company')
                ->type('kvk', '123456789')
                ->press('Register')
                ->assertSee(__('auth.login'));
        });
    }
}

<?php

namespace Tests\Browser\Pages;

use App\Enum\RolesEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\DuskTestCase;

class SettingsTest extends DuskTestCase
{
    public function it_displays_user_details(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/my-account/settings');

        $response->assertStatus(200);
        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }

    /** @test */
    public function it_allows_user_to_generate_api_token() : void
    {
        $user = User::factory()->create();
        if ($user->type === RolesEnum::BUSINESS) {
            Company::factory()->create(['user_id' => $user->id]);
        }
            $this->browse(function ($browser) use ($user) {
                $browser->loginAs($user)
                    ->visit('/my-account/settings')
                    ->type('name', 'Test Token') // Fill in the token name
                    ->press(__('settings.generate_token')); // Submit the form
            });


        $this->assertDatabaseHas('personal_access_tokens', [
            'name' => 'Test Token',
        ]);
        }

    /** @test */
    public function it_allows_business_user_to_update_settings(): void
    {
        $user = User::factory()->create([
            'type' => RolesEnum::BUSINESS,
        ]);
        Company::factory()->create(['user_id' => $user->id]);

        $this->browse(function ($browser) use ($user) {
            $logo = UploadedFile::fake()->image('logo.jpg');
            $banner = UploadedFile::fake()->image('banner.jpg');
            $browser->loginAs($user)
                ->visit('/my-account/settings')
                ->attach('logo', $logo->path())
                ->attach('banner', $banner->path())
                ->type('description', 'Test description')
                ->press(__('global.save'));
        });
        $company = Company::whereJsonContains('config->description', 'Test description');
        $this->assertNotNull($company, 'Failed to find company with the given description in config.');
    }
}
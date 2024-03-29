<?php

namespace Tests\Browser\Pages;

use App\Enum\RolesEnum;
use App\Models\Advert;
use App\Models\AdvertImage;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MyAdvertsPageTest extends DuskTestCase
{
    public function testAdvertPageDisplay(): void
    {
        $user = User::factory()->create(['type' => RolesEnum::PRIVATE_WITH_ADVERTISING]);
        $advert = Advert::factory()->create(['user_id' => $user->id]);

        Storage::fake('public');


        $this->browse(function (Browser $browser) use ($advert, $user) {
            $image = UploadedFile::fake()->image('advert_image.jpg');
            $image_path = $image->store('images', 'public');
            AdvertImage::factory()->create(['advert_id' => $advert->id, 'path' => $image_path]);

            $browser->loginAs($user)
                ->visit('/my-account/adverts')
                ->assertSee($advert->title)
                ->assertSee($advert->description)
                ->assertSee('€' . number_format($advert->price, 2, ','))
                ->assertSee($advert->user->name)
                ->assertAttribute('div.m-4 img', 'src', '/storage/images/' . $image_path); // Check if the image source is equal to the one in the advert
        });
    }
}
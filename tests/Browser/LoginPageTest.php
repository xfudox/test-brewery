<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_see_email_input(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertVisible('input[type=email]');
        });
    }

    public function test_user_see_password_input(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertVisible('input[type=password]');
        });
    }

    public function test_user_see_submit_button(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertVisible("form button");
        });
    }

    public function test_user_can_login(): void
    {
        User::factory()
            ->create([
                "email" => "test@example.com",
                "password" => Hash::make("password")
            ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->value('input[type=email]', 'test@example.com')
                ->value('input[type=password]', 'password')
                ->click('form button');
        });
    }
}

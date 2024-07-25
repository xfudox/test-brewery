<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

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
}

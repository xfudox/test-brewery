<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WelcomePageTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     */
    public function test_anonymous_user_see_login_link(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSeeIn('nav', 'Log in');
        });
    }

    public function test_anonymous_user_see_register_link(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSeeIn('nav', 'Register');
        });
    }

    public function test_authenticated_user_does_not_see_login_link(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->create())
                ->visit('/')
                ->assertDontSeeIn('nav', 'Log in');
        });
    }

    public function test_authenticated_user_does_not_see_register_link(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->create())
                ->visit('/')
                ->assertDontSeeIn('nav', 'Register');
        });
    }
}

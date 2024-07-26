<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DashboardPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_anonymous_user_is_redirected_to_login_page(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dashboard')
                    ->assertPathIs('/login');
        });
    }

    public function test_authenticated_user_can_access_page(): void
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->create())
                ->visit('/dashboard')
                ->assertPathIs('/dashboard');
        });
    }

    public function test_page_header_contains_expected_title(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->create())
                ->visit('/dashboard')
                ->assertSeeIn('header', 'Dashboard');
        });
    }

    public function test_page_contains_breweries_table(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->create())
                ->visit('/dashboard')
                ->assertVisible('table#breweries-table');
        });
    }

    public function test_breweries_table_first_column_is_name_column(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->create())
                ->visit('/dashboard')
                ->assertSeeIn('table#breweries-table thead tr th:nth-of-type(1)', 'Name');
        });
    }

    public function test_breweries_table_second_column_is_website_column(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->create())
                ->visit('/dashboard')
                ->assertSeeIn('table#breweries-table thead tr th:nth-of-type(2)', 'Website');
        });
    }

    public function test_breweries_table_third_column_is_phone_column(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->create())
                ->visit('/dashboard')
                ->assertSeeIn('table#breweries-table thead tr th:nth-of-type(3)', 'Phone');
        });
    }
}

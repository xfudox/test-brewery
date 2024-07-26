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

    public function test_breweries_table_has_three_columns(): void
    {
        $this->browse(function (Browser $browser) {
            $thList = $browser->loginAs(User::factory()->create())
                ->visit('/dashboard')
                ->script("return Array.from(document.querySelectorAll('table#breweries-table thead tr th'))");
            $this->assertCount(3, $thList[0]);
        });

    }

    /** @dataProvider breweriesTableColumnDataProvider */
    public function test_breweries_table_has_expected_column(int $pos, string $label): void
    {
        $this->browse(function (Browser $browser) use ($pos, $label) {
            $selector = "table#breweries-table thead tr th:nth-of-type($pos)";
            $browser->loginAs(User::factory()->create())
                ->visit('/dashboard')
                ->assertSeeIn($selector, $label);
        });
    }

    static public function breweriesTableColumnDataProvider()
    {
        return [
            'name'    => [1, 'Name'],
            'website' => [2, 'Website'],
            'phone'   => [3, 'Phone'],
        ];
    }
}

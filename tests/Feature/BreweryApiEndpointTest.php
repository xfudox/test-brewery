<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;


class BreweryApiEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_route_cannot_be_called_by_anonymous_user(): void
    {
        $response = $this->get(route("breweries"), ["Accept"=>"application/json"]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
    public function test_route_can_be_called_by_authenticated_user(): void
    {
        Sanctum::actingAs(
            User::factory()->create()
        );
        $response = $this->get(route("breweries"));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_route_returns_10_items_by_default(): void
    {
        Sanctum::actingAs(
            User::factory()->create()
        );
        $response = $this->get(route("breweries"));

        $this->assertCount(
            10,
            $response->json()
        );
    }

    public function test_route_returns_expected_number_of_items_if_specified(): void
    {
        Sanctum::actingAs(
            User::factory()->create()
        );
        $response = $this->get(route("breweries",['per_page'=>5]));

        $this->assertCount(
            5,
            $response->json()
        );
    }

    public function test_route_returns_first_pagination_page_by_default(): void
    {
        /**
         * Non c'è effettivemente modo di testare questa funzionalità in quanto
         * openbrewerydb.org non ritorna le informazioni di paginazione insieme ai
         * risultati.
         */
        Sanctum::actingAs(
            User::factory()->create()
        );
        $response = $this->get(route("breweries"));

        $this->markTestSkipped();
    }

    public function test_route_returns_expected_pagination_page_if_specified(): void
    {
        /**
         * Non c'è effettivemente modo di testare questa funzionalità in quanto
         * openbrewerydb.org non ritorna le informazioni di paginazione insieme ai
         * risultati.
         */
        Sanctum::actingAs(
            User::factory()->create()
        );
        $response = $this->get(route("breweries", ['page'=>5]));

        $this->markTestSkipped();
    }

}

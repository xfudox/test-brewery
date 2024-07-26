<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BreweryService {
    private string $breweryApiUrl='https://api.openbrewerydb.org/v1/breweries';

    public function fetch(int $page, int $per_page) {
        return Http::get($this->breweryApiUrl, ['page'=> $page, 'per_page'=> $per_page]);
    }
}
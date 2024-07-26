<?php

namespace App\Interfaces;

interface BreweryService {

    public function fetch(int $page, int $per_page);
}
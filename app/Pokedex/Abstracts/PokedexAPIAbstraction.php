<?php

namespace App\Pokedex\Abstracts;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Exception;

abstract class PokedexAPIAbstraction
{
    protected string $endpoint = 'https://pokeapi.co/api/v2';

    /*
     * Cache the response for an hour
     * Performance benefits as well as Fair Usage on Pokédex API
     */
    public function getResponse(): mixed
    {
        $endpointKey = encrypt($this->endpoint);
        $response = Cache::get($endpointKey);

        if ($response === null) {
            $response = Http::get($this->endpoint)->json();
            Cache::put($endpointKey, $response, 3600);
        }

        return $response;
    }
}

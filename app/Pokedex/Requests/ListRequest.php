<?php

namespace App\Pokedex\Requests;

use App\Pokedex\Abstracts\PokedexAPIAbstraction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ListRequest extends PokedexAPIAbstraction
{
    protected string $endpoint = 'https://pokeapi.co/api/v2/pokemon/?offset=0&limit=500';

    /*
     * Override the abstract method here to support retrieving the paginated results
     * Continue to cache each URL uniquely
     */
    public function getResponse(): mixed
    {
        $endpointKey = encrypt($this->endpoint);
        $response = Cache::get($endpointKey);

        if ($response === null) {
            $response = Http::get($this->endpoint)->json();
            Cache::put($endpointKey, $response, 3600);
        }

        $results = $response['results'] ?? [];
        if (empty($results)) {
            return [];
        }

        $next = $response['next'] ?? null;

        while ($next) {

            $endpointKey = encrypt($next);
            $response = Cache::get($endpointKey);

            if ($response === null) {
                $response = Http::get($this->endpoint)->json();
                Cache::put($endpointKey, $response, 3600);
            }

            $response = Http::get($next)->json();
            $results = array_merge($results, $response['results']);
            $next = $response['next'] ?? null;
        }

        return $results;
    }
}

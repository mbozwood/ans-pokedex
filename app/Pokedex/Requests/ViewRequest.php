<?php

namespace App\Pokedex\Requests;

use App\Pokedex\Abstracts\PokedexAPIAbstraction;
use App\Pokedex\Contracts\PokedexApiContract;

class ViewRequest extends PokedexAPIAbstraction implements PokedexApiContract
{
    public function __construct(string $name)
    {
        $this->endpoint = 'https://pokeapi.co/api/v2/pokemon/'.$name;
    }
}

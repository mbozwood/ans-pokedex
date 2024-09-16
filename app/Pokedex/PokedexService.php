<?php

namespace App\Pokedex;

use App\Pokedex\Requests\ListRequest;
use App\Pokedex\Requests\ViewRequest;

class PokedexService
{
    public function list()
    {
        return (new ListRequest)->getResponse();
    }

    public function view(string $name)
    {
        return (new ViewRequest($name))->getResponse();
    }
}

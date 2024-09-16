<?php

namespace App\Pokedex\Contracts;

interface PokedexApiContract
{
    public function getResponse(): mixed;
}

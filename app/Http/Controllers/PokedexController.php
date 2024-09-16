<?php

namespace App\Http\Controllers;

use App\Pokedex\PokedexService;

class PokedexController extends Controller
{
    public function __construct(protected PokedexService $pokedexService) {}

    public function list()
    {
        return $this->pokedexService->list();
    }

    public function view(string $name)
    {
        return $this->pokedexService->view($name);
    }
}

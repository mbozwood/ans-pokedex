<?php

use App\Http\Controllers\PokedexController;
use Illuminate\Support\Facades\Route;

Route::prefix('pokedex')->controller(PokedexController::class)->group(function () {
    Route::get('/', 'list');
    Route::get('{name}', 'view');
});

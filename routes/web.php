<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DeckController;

/*Route::get('/', function () {
    return view('index', [CardController::class, 'index']);
});*/

route::get('/', [DeckController::class, 'index'])->name('decks.index');
route::get('/create', [DeckController::class, 'create'])->name('decks.create');
route::post('/store', [DeckController::class, 'store'])->name('decks.store');

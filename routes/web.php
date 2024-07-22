<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DeckController;

/*Route::get('/', function () {
    return view('index', [CardController::class, 'index']);
});*/

route::get('/', [DeckController::class, 'index'])->name('decks.main');
route::post('/store', [DeckController::class, 'store'])->name('decks.store');
route::get('/create', [DeckController::class, 'create'])->name('decks.create');
route::get('/create/{card_type?}/{currentCards?}', [DeckController::class, 'create'])->name('decks.create');
route::get('/update/{id_deck}', [DeckController::class, 'edit'])->name('decks.update');
route::get('/update/{card_type?}/{currentCards?}', [DeckController::class, 'edit'])->name('decks.update');
route::post('/updateDeck', [DeckController::class, 'updateDeck'])->name('decks.updateDeck');
Route::post('/decks/{deck}', [DeckController::class, 'delete'])->name('decks.delete');


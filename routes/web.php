<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;

Route::get('/', function () {
    return view('test', ['name'=>'Edu']);
});

route::get('test', [CardController::class, 'index']);

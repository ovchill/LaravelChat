<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LobbiesController;
use Illuminate\Support\Facades\Route;

Route::get('/CategoriesController/getCategoriesForFront', [CategoriesController::class, 'getCategoriesForFront']);
Route::get('/LobbiesController/findLobby', [LobbiesController::class, 'findLobby']);

Route::get('/{any}', static function () {
    return view('app');
})->where('any', '.*');


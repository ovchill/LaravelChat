<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::get('/CategoriesController/getCategoriesForFront', [CategoriesController::class, 'getCategoriesForFront']);

Route::get('/{any}', static function () {
    return view('app');
})->where('any', '.*');


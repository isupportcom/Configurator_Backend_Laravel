<?php

use App\Http\Controllers\CardsPlace\CardsPlaceController;
use App\Http\Controllers\ChoicesContent\ChoicesContentController;
use App\Http\Controllers\FinalProduct\FinalProductController;
use App\Http\Controllers\PlaceChoices\PlaceChoicesController;
use App\Http\Controllers\ProductsCard\ProductsCardController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource("final_product", FinalProductController::class, ['only' => ['index', 'store', 'update', 'destroy']]);
Route::resource("products-card", ProductsCardController::class, ['only' => ['index', 'store', 'update', 'destroy']]);
Route::resource("card-place", CardsPlaceController::class, ['only' => ['index', 'store', 'update', 'destroy']]);
Route::resource("place-choices", PlaceChoicesController::class, ['only' => ['index', 'store', 'update', 'destroy']]);
Route::resource('choices-content', ChoicesContentController::class, ['only' => ['index', 'store', 'update', 'destroy']]);

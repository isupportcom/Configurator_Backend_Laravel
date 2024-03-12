<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackgroundImage\BackgroundImageController;
use App\Http\Controllers\CardsPlace\CardsPlaceController;
use App\Http\Controllers\CardsPlace\CardsPlaceLayerImage;
use App\Http\Controllers\Colors\ColorsController;
use App\Http\Controllers\FinalProduct\FinalProductController;
use App\Http\Controllers\FinalProduct\FinalProductsLayersController;
use App\Http\Controllers\FinalProduct\FinalProductCategoryContentController;
use App\Http\Controllers\FinalProduct\FinalProductCategoriesController;
use App\Http\Controllers\Icons\IconsController;
use App\Http\Controllers\Images\ImagesController;
use App\Http\Controllers\PlaceChoices\PlaceChoicesController;
use App\Http\Controllers\ProductsCard\ProductsCardController;
use App\Http\Controllers\Rules\RulesCndController as RulesRulesCndController;
use App\Http\Controllers\Rules\RulesController;
use App\Http\Controllers\Rules\RulesItemController;
use App\Http\Controllers\RulesCnd\RulesCndController;
use App\Http\Controllers\FinalProductLayers\FinalProdutsLayersController;
use App\Http\Controllers\FinalProductLayers\LayerImageOutputController;
use App\Http\Controllers\ImageConfiguration\ImageConfigurationController;
use App\Http\Controllers\ImagesOuput\ImagesOuputController;
use App\Http\Controllers\LayerEntity\LayerEntityController;
use App\Http\Controllers\LayerImages\LayerImagesController;
use App\Http\Controllers\DefaultSelections\DefaultSelectionsController;
use App\Http\Controllers\Materials\MaterialsController;
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

Route::resource("final_product", FinalProductController::class, ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
Route::resource("final_product.products-cards", ProductsCardController::class, ['only' => 'index']);
Route::resource('final_product.layers', FinalProductsLayersController::class, ['only' => 'index']);
Route::resource('final_product.category_content',FinalProductCategoryContentController::class, ['only' => 'index']);
Route::resource('final_product.categories',FinalProductCategoriesController::class, ['only' => 'index']);
Route::resource("products-card", ProductsCardController::class, ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource("card-place", CardsPlaceController::class, ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
Route::resource("card-place.layer_images",CardsPlaceLayerImage::class,['only'=>['index']]);
Route::resource("place-choices", PlaceChoicesController::class, ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
Route::resource("materials", MaterialsController::class, ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
Route::resource('icons', IconsController::class, ['only' => 'index']);

Route::resource('rules', RulesController::class, ['only' => ['store', 'show', 'destroy', 'index']]);
Route::resource('rules.items', RulesItemController::class, ['only' => ['index']]);
Route::resource('rules.cnd', RulesRulesCndController::class, ['only' => ['index']]);

Route::resource('rules-cnd', RulesCndController::class, ['except' => ['create', 'edit', 'index',]]);

Route::resource('colors', ColorsController::class, ['except' => ['destroy,show', 'store']]);

Route::resource('final_product_layers', FinalProdutsLayersController::class, ['only' => ['index', 'show', 'update']]);
Route::resource('final_product_layers.output', LayerImageOutputController::class, ['only' => ['index']]);
Route::resource('layer_images', LayerImagesController::class, ['except'=>'update']);
Route::resource('image-config', ImageConfigurationController::class);
Route::resource('layer_entities', LayerEntityController::class, ['only' => ['store','index','show', 'destroy', 'update']]);
Route::resource('default_selections', DefaultSelectionsController::class, ['only' => ['store','index','show', 'destroy', 'update']]);
Route::resource('images-output', ImagesOuputController::class);


Route::resource('background_image', BackgroundImageController::class, ['only' => ['update', 'show']]);




Route::get('/images/{filename}', [ImagesController::class, 'show']);
Route::post('/images/logo', [ImagesController::class, 'store']);
// User login
Route::post('login', [AuthController::class, 'login']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MinerController;
use App\Http\Controllers\LiveController;
use App\Http\Controllers\ItemDetailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route::apiResource('/miner', MinerController::class);
route::apiResource('/live', LiveController::class);
route::apiResource('/item-detail', ItemDetailController::class);
route::get('/item-detail-top-miners', [ItemDetailController::class, 'topMiners']);
route::get('/item-detail-sales-today', [ItemDetailController::class, 'loadSalesToday']);
route::get('/item-detail-sales-monthly/{date}', [ItemDetailController::class, 'loadSalesMonthly']);
route::get('/item-detail-sales-date-range', [ItemDetailController::class, 'loadSalesByDateRange']);
route::get('/item-detail-this-live-top-miners/{id}', [ItemDetailController::class, 'thisLiveTopMiners']);

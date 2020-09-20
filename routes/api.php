<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\WoocommerceWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('wc')
    ->middleware('auth:sanctum')
    ->group(function() {}); // TODO: Add REST to interact with integrated products

Route::prefix('wc/webhook')
    ->middleware('woocommerce-webhook')
    ->group(function() {

        Route::apiResource('/', WoocommerceWebhookController::class);
    });

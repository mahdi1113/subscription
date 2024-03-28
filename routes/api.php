<?php

use App\Http\Controllers\abilitie\AbilitieController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\buy\BuyController;
use App\Http\Controllers\subscription\SubscriptionController;
use App\Http\Controllers\useAbility\UseAbilityController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('buySubscription', [BuyController::class, 'store'])->middleware('CheckSubscription');
    Route::apiResource('subscriptions', SubscriptionController::class)->except('show');
    Route::apiResource('abilities', AbilitieController::class)->only('index', 'store');
    Route::post('useAbility', [UseAbilityController::class, 'useAbility'])->middleware('CheckUseAbility');
});

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);
